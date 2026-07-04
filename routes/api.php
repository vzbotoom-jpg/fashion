<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
| These routes are loaded by the RouteServiceProvider within a group
| which is assigned the "api" middleware group.
|
*/

// ============================================================
// PUBLIC API ROUTES
// ============================================================

// Products
Route::prefix('products')->name('api.products.')->group(function () {
    Route::get('/filter', [ProductController::class, 'filter'])->name('filter');
    Route::get('/search', [ProductController::class, 'search'])->name('search');
});

// Shipping
Route::post('/shipping/calculate', function (Request $request) {
    // Calculate shipping cost based on address and cart total
    $address = $request->input('address');
    $subtotal = $request->input('subtotal', 0);

    // Basic shipping calculation
    $shippingCost = 20000; // Default standard
    if ($subtotal >= 500000) {
        $shippingCost = 0; // Free shipping
    } elseif ($request->input('method') === 'express') {
        $shippingCost = 50000;
    } elseif ($request->input('method') === 'same_day') {
        $shippingCost = 100000;
    }

    return response()->json([
        'success' => true,
        'shipping_cost' => $shippingCost,
        'formatted' => 'Rp ' . number_format($shippingCost, 0, ',', '.'),
        'is_free' => $shippingCost === 0,
    ]);
})->name('api.shipping.calculate');

// ============================================================
// PUBLIC API ROUTES
// ============================================================

// Cart API
Route::prefix('cart')->name('api.cart.')->group(function () {
    Route::get('/count', function () {
        $count = auth()->check() ? 
            \App\Services\CartService::getCartCount(auth()->id()) : 0;
        return response()->json(['count' => $count]);
    })->name('count');
});

// ============================================================
// AUTHENTICATED API ROUTES
// ============================================================
Route::middleware('auth:sanctum')->group(function () {

    // User Profile
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    })->name('api.user');

    Route::prefix('cart')->name('api.cart.')->group(function () {
        Route::get('/items', function () {
            $cart = \App\Services\CartService::getCart(auth()->id());
            return response()->json([
                'items' => $cart->items->load(['product', 'size']),
                'total' => $cart->total,
                'items_count' => $cart->items_count,
            ]);
        })->name('items');
    });

    // Orders API
    Route::prefix('orders')->name('api.orders.')->group(function () {
        Route::get('/', function () {
            if (!auth()->check()) {
                return response()->json(['orders' => []]);
            }
            $orders = \App\Models\Order::where('user_id', auth()->id())
                ->with(['items.product', 'payment'])
                ->orderBy('created_at', 'desc')
                ->get();
            return response()->json(['orders' => $orders]);
        })->name('index');

        Route::get('/{id}', function ($id) {
            $order = \App\Models\Order::where('user_id', auth()->id())
                ->with(['items.product', 'items.size', 'payment', 'statuses'])
                ->findOrFail($id);
            return response()->json($order);
        })->name('show');
    });

    // Pre-Orders API
    Route::prefix('pre-orders')->name('api.pre-orders.')->group(function () {
        Route::get('/', function () {
            if (!auth()->check()) {
                return response()->json(['pre_orders' => []]);
            }
            $preOrders = \App\Models\PreOrder::where('user_id', auth()->id())
                ->with(['product', 'size'])
                ->orderBy('created_at', 'desc')
                ->get();
            return response()->json(['pre_orders' => $preOrders]);
        })->name('index');
    });

    // Custom Orders API
    Route::prefix('custom-orders')->name('api.custom-orders.')->group(function () {
        Route::get('/', function () {
            if (!auth()->check()) {
                return response()->json(['custom_orders' => []]);
            }
            $customOrders = \App\Models\CustomOrder::where('user_id', auth()->id())
                ->with(['product', 'size'])
                ->orderBy('created_at', 'desc')
                ->get();
            return response()->json(['custom_orders' => $customOrders]);
        })->name('index');
    });
});

// ============================================================
// ADMIN API ROUTES
// ============================================================
Route::middleware(['auth:sanctum', 'role:admin,super_admin'])
    ->prefix('admin')
    ->name('api.admin.')
    ->group(function () {

        // Dashboard Stats
        Route::get('/dashboard/stats', function () {
            $stats = [
                'total_orders' => \App\Models\Order::count(),
                'total_revenue' => \App\Models\Order::where('status', 'completed')->sum('grand_total'),
                'total_products' => \App\Models\Product::count(),
                'total_customers' => \App\Models\User::where('role', 'customer')->count(),
                'pending_orders' => \App\Models\Order::where('status', 'pending')->count(),
                'pending_pre_orders' => \App\Models\PreOrder::where('status', 'pending')->count(),
            ];
            return response()->json($stats);
        })->name('dashboard.stats');

        // Sales Data
        Route::get('/sales/data', function (Request $request) {
            $days = $request->input('days', 30);
            $data = [];
            $startDate = now()->subDays($days - 1)->startOfDay();

            for ($i = 0; $i < $days; $i++) {
                $date = $startDate->copy()->addDays($i);
                $revenue = \App\Models\Order::whereDate('created_at', $date)
                    ->where('status', 'completed')
                    ->sum('grand_total');
                $data[] = [
                    'date' => $date->format('Y-m-d'),
                    'label' => $date->format('d M'),
                    'revenue' => $revenue,
                ];
            }
            return response()->json($data);
        })->name('sales.data');
    });

// ============================================================
// TEST ROUTE
// ============================================================
Route::get('/ping', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'API is working',
        'timestamp' => now()->toISOString(),
    ]);
})->name('api.ping');