<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PreOrder;
use App\Models\CustomOrder;
use App\Models\Product;
use App\Models\User;
use App\Services\AnalyticsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $analyticsService;

    public function __construct(AnalyticsService $analyticsService)
    {
        $this->analyticsService = $analyticsService;
        $this->middleware(['auth', 'role:admin,super_admin']);
    }

    public function index()
    {
        $stats = [
            'total_orders' => Order::count(),
            'total_pre_orders' => PreOrder::count(),
            'total_custom_orders' => CustomOrder::count(),
            'total_products' => Product::count(),
            'total_users' => User::where('role', 'customer')->count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'revenue_today' => Order::whereDate('created_at', today())->sum('total'),
            'revenue_this_month' => Order::whereMonth('created_at', now()->month)->sum('total'),
        ];

        $recentOrders = Order::with(['user', 'payment'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $recentPreOrders = PreOrder::with(['user', 'product'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $salesData = $this->analyticsService->getSalesData(30);
        $topProducts = $this->analyticsService->getTopProducts(10);

        return view('admin.dashboard', compact(
            'stats',
            'recentOrders',
            'recentPreOrders',
            'salesData',
            'topProducts'
        ));
    }
}