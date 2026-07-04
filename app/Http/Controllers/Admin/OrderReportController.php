<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PreOrder;
use App\Models\CustomOrder;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
        $this->middleware(['auth', 'role:admin,super_admin']);
    }

    public function orders(Request $request)
    {
        $startDate = $request->start_date ?? now()->subDays(30)->format('Y-m-d');
        $endDate = $request->end_date ?? now()->format('Y-m-d');

        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->with(['user', 'payment'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $summary = [
            'total_orders' => Order::whereBetween('created_at', [$startDate, $endDate])->count(),
            'total_revenue' => Order::whereBetween('created_at', [$startDate, $endDate])
                ->where('status', 'completed')
                ->sum('total'),
            'total_products' => Order::whereBetween('created_at', [$startDate, $endDate])
                ->with('items')
                ->get()
                ->sum(function($order) {
                    return $order->items->sum('quantity');
                }),
            'average_order_value' => Order::whereBetween('created_at', [$startDate, $endDate])
                ->where('status', 'completed')
                ->avg('total') ?? 0,
        ];

        return view('admin.reports.orders', compact('orders', 'summary', 'startDate', 'endDate'));
    }

    public function sales(Request $request)
    {
        $year = $request->year ?? now()->year;
        $month = $request->month ?? now()->month;

        $salesData = $this->reportService->getMonthlySalesReport($year, $month);
        $topProducts = $this->reportService->getTopSellingProducts($month, $year, 10);
        $salesByCategory = $this->reportService->getSalesByCategory($month, $year);

        return view('admin.reports.sales', compact('salesData', 'topProducts', 'salesByCategory', 'year', 'month'));
    }

    public function stock(Request $request)
    {
        $products = DB::table('products')
            ->join('product_sizes', 'products.id', '=', 'product_sizes.product_id')
            ->select(
                'products.id',
                'products.name',
                'products.sku',
                'product_sizes.size_id',
                'product_sizes.stock',
                'product_sizes.min_stock'
            )
            ->orderBy('product_sizes.stock')
            ->paginate(20);

        $lowStockProducts = collect($products->items())->filter(function($item) {
            return $item->stock <= $item->min_stock;
        });

        return view('admin.reports.stock', compact('products', 'lowStockProducts'));
    }
}