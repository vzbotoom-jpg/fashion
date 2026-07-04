<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\PreOrder;
use App\Models\CustomOrder;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class AnalyticsService
{
    public function getDashboardStats()
    {
        $today = now()->startOfDay();
        $monthStart = now()->startOfMonth();

        return [
            'total_orders' => Order::count(),
            'total_revenue' => Order::where('status', 'completed')->sum('grand_total'),
            'total_products' => Product::count(),
            'total_customers' => User::where('role', 'customer')->count(),
            
            'orders_today' => Order::whereDate('created_at', $today)->count(),
            'revenue_today' => Order::whereDate('created_at', $today)
                ->where('status', 'completed')
                ->sum('grand_total'),
            
            'orders_this_month' => Order::whereMonth('created_at', now()->month)->count(),
            'revenue_this_month' => Order::whereMonth('created_at', now()->month)
                ->where('status', 'completed')
                ->sum('grand_total'),
            
            'pending_orders' => Order::where('status', 'pending')->count(),
            'pending_pre_orders' => PreOrder::where('status', 'pending')->count(),
            'pending_custom_orders' => CustomOrder::where('status', 'pending')->count(),
            
            'new_customers_today' => User::where('role', 'customer')
                ->whereDate('created_at', $today)
                ->count(),
        ];
    }

    public function getSalesData($days = 30)
    {
        $data = [];
        $startDate = now()->subDays($days - 1)->startOfDay();

        for ($i = 0; $i < $days; $i++) {
            $date = $startDate->copy()->addDays($i);
            $dateString = $date->format('Y-m-d');

            $orderCount = Order::whereDate('created_at', $date)
                ->count();

            $revenue = Order::whereDate('created_at', $date)
                ->where('status', 'completed')
                ->sum('grand_total');

            $data[] = [
                'date' => $dateString,
                'label' => $date->format('d M'),
                'orders' => $orderCount,
                'revenue' => $revenue,
            ];
        }

        return $data;
    }

    public function getTopProducts($limit = 10)
    {
        return DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completed')
            ->select(
                'products.id',
                'products.name',
                DB::raw('SUM(order_items.quantity) as total_sold'),
                DB::raw('SUM(order_items.total) as total_revenue')
            )
            ->groupBy('products.id', 'products.name')
            ->orderBy('total_sold', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getPreOrderStats($period = 30)
    {
        $startDate = now()->subDays($period);
        
        return [
            'total' => PreOrder::where('created_at', '>=', $startDate)->count(),
            'pending' => PreOrder::where('created_at', '>=', $startDate)
                ->where('status', 'pending')
                ->count(),
            'completed' => PreOrder::where('created_at', '>=', $startDate)
                ->where('status', 'completed')
                ->count(),
            'cancelled' => PreOrder::where('created_at', '>=', $startDate)
                ->where('status', 'cancelled')
                ->count(),
            'by_product' => PreOrder::where('created_at', '>=', $startDate)
                ->select('product_id', DB::raw('COUNT(*) as total'))
                ->with('product')
                ->groupBy('product_id')
                ->orderBy('total', 'desc')
                ->limit(5)
                ->get(),
        ];
    }

    public function getCustomOrderStats($period = 30)
    {
        $startDate = now()->subDays($period);
        
        return [
            'total' => CustomOrder::where('created_at', '>=', $startDate)->count(),
            'pending' => CustomOrder::where('created_at', '>=', $startDate)
                ->where('status', 'pending')
                ->count(),
            'in_production' => CustomOrder::where('created_at', '>=', $startDate)
                ->whereIn('status', ['review', 'design', 'production'])
                ->count(),
            'completed' => CustomOrder::where('created_at', '>=', $startDate)
                ->where('status', 'completed')
                ->count(),
            'cancelled' => CustomOrder::where('created_at', '>=', $startDate)
                ->where('status', 'cancelled')
                ->count(),
            'by_status' => CustomOrder::where('created_at', '>=', $startDate)
                ->select('status', DB::raw('COUNT(*) as total'))
                ->groupBy('status')
                ->get(),
        ];
    }

    public function getPaymentMethodStats($period = 30)
    {
        $startDate = now()->subDays($period);
        
        return Payment::where('created_at', '>=', $startDate)
            ->where('status', 'completed')
            ->select('payment_method', DB::raw('COUNT(*) as total'), DB::raw('SUM(amount) as total_amount'))
            ->groupBy('payment_method')
            ->get();
    }

    public function getCustomerRetentionRate($period = 30)
    {
        $startDate = now()->subDays($period);
        
        $totalCustomers = User::where('role', 'customer')
            ->where('created_at', '<=', $startDate)
            ->count();

        $returningCustomers = User::where('role', 'customer')
            ->whereHas('orders', function ($query) use ($startDate) {
                $query->where('created_at', '>=', $startDate)
                    ->where('status', 'completed');
            })
            ->count();

        return [
            'total_customers' => $totalCustomers,
            'returning_customers' => $returningCustomers,
            'retention_rate' => $totalCustomers > 0 
                ? round(($returningCustomers / $totalCustomers) * 100, 2) 
                : 0,
        ];
    }

    public function getConversionRate($period = 30)
    {
        // This is a simplified conversion rate
        // In production, you might track actual website visitors
        $startDate = now()->subDays($period);
        
        $totalVisitors = $this->getTotalVisitors($period);
        $totalOrders = Order::where('created_at', '>=', $startDate)->count();
        
        return [
            'total_visitors' => $totalVisitors,
            'total_orders' => $totalOrders,
            'conversion_rate' => $totalVisitors > 0 
                ? round(($totalOrders / $totalVisitors) * 100, 2) 
                : 0,
        ];
    }

    protected function getTotalVisitors($period)
    {
        // This is a placeholder. In production, you'd use analytics data
        // Could be from Google Analytics API, custom tracking, etc.
        return rand(1000, 5000);
    }

    public function getAverageOrderValue($period = 30)
    {
        $startDate = now()->subDays($period);
        
        $avgOrderValue = Order::where('created_at', '>=', $startDate)
            ->where('status', 'completed')
            ->avg('grand_total');

        return round($avgOrderValue ?? 0, 2);
    }

    public function getDailyVisitors($period = 30)
    {
        // Placeholder data
        $data = [];
        $startDate = now()->subDays($period - 1);
        
        for ($i = 0; $i < $period; $i++) {
            $date = $startDate->copy()->addDays($i);
            $data[] = [
                'date' => $date->format('Y-m-d'),
                'visitors' => rand(50, 200),
            ];
        }
        
        return $data;
    }

    public function getCategoryPerformance($period = 30)
    {
        $startDate = now()->subDays($period);
        
        return DB::table('categories')
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.created_at', '>=', $startDate)
            ->where('orders.status', 'completed')
            ->select(
                'categories.id',
                'categories.name',
                DB::raw('SUM(order_items.quantity) as total_sold'),
                DB::raw('SUM(order_items.total) as total_revenue')
            )
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('total_revenue', 'desc')
            ->get();
    }

    public function getCustomerDemographics()
    {
        // Placeholder data for customer demographics
        $total = User::where('role', 'customer')->count();
        
        return [
            'total' => $total,
            'by_city' => User::where('role', 'customer')
                ->select('city', DB::raw('COUNT(*) as total'))
                ->whereNotNull('city')
                ->groupBy('city')
                ->orderBy('total', 'desc')
                ->limit(5)
                ->get(),
            'by_province' => User::where('role', 'customer')
                ->select('province', DB::raw('COUNT(*) as total'))
                ->whereNotNull('province')
                ->groupBy('province')
                ->orderBy('total', 'desc')
                ->limit(5)
                ->get(),
        ];
    }
}