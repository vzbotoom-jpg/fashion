<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\PreOrderController;
use App\Http\Controllers\Frontend\CustomOrderController;
use App\Http\Controllers\Frontend\OrderTrackingController;
use App\Http\Controllers\Auth\ProfileController;

/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
|
| These routes are only accessible for authenticated users with
| role 'customer'.
|
*/

Route::middleware(['auth', 'role:customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {

        // ============================================================
        // CART ROUTES
        // ============================================================
        Route::prefix('cart')->name('cart.')->group(function () {
            Route::get('/', [CartController::class, 'index'])->name('index');
            Route::post('/add', [CartController::class, 'add'])->name('add');
            Route::put('/update/{id}', [CartController::class, 'update'])->name('update');
            Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
            Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
        });

        // ============================================================
        // CHECKOUT ROUTES
        // ============================================================
        Route::prefix('checkout')->name('checkout.')->group(function () {
            Route::get('/', [CheckoutController::class, 'index'])->name('index');
            Route::post('/', [CheckoutController::class, 'store'])->name('store');
        });

        // ============================================================
        // PRE-ORDER ROUTES
        // ============================================================
        Route::prefix('pre-order')->name('pre-order.')->group(function () {
            Route::get('/create/{product}', [PreOrderController::class, 'create'])->name('create');
            Route::post('/', [PreOrderController::class, 'store'])->name('store');
            Route::get('/success', [PreOrderController::class, 'success'])->name('success');
        });

        // ============================================================
        // CUSTOM ORDER ROUTES
        // ============================================================
        Route::prefix('custom-order')->name('custom-order.')->group(function () {
            Route::get('/create/{product?}', [CustomOrderController::class, 'create'])->name('create');
            Route::post('/', [CustomOrderController::class, 'store'])->name('store');
            Route::get('/success', [CustomOrderController::class, 'success'])->name('success');
        });

        // ============================================================
        // ORDERS ROUTES
        // ============================================================
        Route::prefix('my-orders')->name('orders.')->group(function () {
            Route::get('/', [OrderTrackingController::class, 'index'])->name('index');
            Route::get('/{id}', [OrderTrackingController::class, 'show'])->name('show');
            Route::get('/track/{id}', [OrderTrackingController::class, 'track'])->name('track');
        });

        // ✅ ALIAS untuk customer.orders (tanpa .index) untuk kompatibilitas header
        Route::get('/orders', [OrderTrackingController::class, 'index'])->name('orders');

        // ✅ ALIAS untuk customer.profile
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');

        // ============================================================
        // PROFILE ROUTES
        // ============================================================
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
            Route::put('/update', [ProfileController::class, 'update'])->name('update');
        });
    });