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

// ❌ HAPUS: use Illuminate\Routing\Controllers\HasMiddleware;
// ❌ HAPUS: use Illuminate\Routing\Controllers\Middleware;

class DashboardController extends Controller // ❌ HAPUS: implements HasMiddleware
{
    protected $analyticsService;

    public function __construct(AnalyticsService $analyticsService)
    {
        $this->analyticsService = $analyticsService;
        
        // ✅ Tambahkan middleware di constructor
        $this->middleware(['auth', 'role:admin,super_admin']);
    }

    // ❌ HAPUS method middleware() ini:
    // public static function middleware(): array
    // {
    //     return [
    //         new Middleware('auth'),
    //         new Middleware('role:admin,super_admin'),
    //     ];
    // }

    public function index()
    {
        $stats = [
            'total_orders' => Order::count(),
            'revenue_this_month' => Order::whereMonth('created_at', now()->month)->where('status', '!=', 'cancelled')->sum('grand_total'),
            'pending_pre_orders' => PreOrder::where('status', 'pending')->count(),
            'total_products' => Product::count(),
            'total_users' => User::where('role', 'customer')->count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
        ];

        $recentOrders = Order::with(['user', 'payment'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $recentPreOrders = PreOrder::with(['user', 'product'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Tambahkan fallback jika AnalyticsService error
        try {
            $salesData = $this->analyticsService->getSalesData(30);
            $topProducts = $this->analyticsService->getTopProducts(10);
        } catch (\Exception $e) {
            $salesData = [];
            $topProducts = [];
        }

        return view('admin.dashboard', compact(
            'stats',
            'recentOrders',
            'recentPreOrders',
            'salesData',
            'topProducts'
        ));
    }
}