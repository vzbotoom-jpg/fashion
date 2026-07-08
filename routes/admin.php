<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductManagementController;
use App\Http\Controllers\Admin\CollectionManagementController;
use App\Http\Controllers\Admin\CategoryManagementController;
use App\Http\Controllers\Admin\PreOrderManagementController;
use App\Http\Controllers\Admin\CustomOrderManagementController;
use App\Http\Controllers\Admin\GalleryManagementController;
use App\Http\Controllers\Admin\TestimonialManagementController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\OrderReportController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\StockManagementController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\ChartController;

// Super Admin Controllers
use App\Http\Controllers\Admin\SuperAdmin\UserManagementController;
use App\Http\Controllers\Admin\SuperAdmin\SettingController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| These routes are only accessible for authenticated users with
| role 'admin' or 'super_admin'.
|
*/

Route::middleware(['auth', 'role:admin,super_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // ============================================================
        // SEARCH
        // ============================================================
        Route::get('/search', [SearchController::class, 'index'])->name('search');

        // ============================================================
        // DASHBOARD
        // ============================================================
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // ============================================================
        // ORDER LIST
        // ============================================================
        Route::get('/orders', [OrderReportController::class, 'orders'])->name('orders.index');

        // ============================================================
        // PRODUCT MANAGEMENT
        // ============================================================
        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', [ProductManagementController::class, 'index'])->name('index');
            Route::get('/create', [ProductManagementController::class, 'create'])->name('create');
            Route::post('/', [ProductManagementController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ProductManagementController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ProductManagementController::class, 'update'])->name('update');
            Route::delete('/{id}', [ProductManagementController::class, 'destroy'])->name('destroy');

            // ✅ Stock Management
            Route::get('/stock', [StockManagementController::class, 'index'])->name('stock.index');
            Route::get('/{id}/stock', [StockManagementController::class, 'edit'])->name('stock.edit');
            Route::put('/{id}/stock', [StockManagementController::class, 'update'])->name('stock.update');
            Route::post('/stock/bulk', [StockManagementController::class, 'bulkUpdate'])->name('stock.bulk');
        });

        // ============================================================
        // COLLECTION MANAGEMENT
        // ============================================================
        Route::resource('collections', CollectionManagementController::class)
            ->except(['show']);

        // ============================================================
        // CATEGORY MANAGEMENT
        // ============================================================
        Route::resource('categories', CategoryManagementController::class)
            ->except(['show']);

        // ============================================================
        // PRE-ORDER MANAGEMENT
        // ============================================================
        Route::prefix('pre-orders')->name('pre-orders.')->group(function () {
            Route::get('/', [PreOrderManagementController::class, 'index'])->name('index');
            Route::get('/{id}', [PreOrderManagementController::class, 'show'])->name('show');
            Route::put('/{id}/process', [PreOrderManagementController::class, 'process'])->name('process');
            Route::delete('/{id}', [PreOrderManagementController::class, 'destroy'])->name('destroy');
        });

        // ============================================================
        // CUSTOM ORDER MANAGEMENT
        // ============================================================
        Route::prefix('custom-orders')->name('custom-orders.')->group(function () {
            Route::get('/', [CustomOrderManagementController::class, 'index'])->name('index');
            Route::get('/{id}', [CustomOrderManagementController::class, 'show'])->name('show');
            Route::put('/{id}/process', [CustomOrderManagementController::class, 'process'])->name('process');
            Route::delete('/{id}', [CustomOrderManagementController::class, 'destroy'])->name('destroy');
        });

        // ============================================================
        // GALLERY MANAGEMENT
        // ============================================================
        Route::resource('gallery', GalleryManagementController::class)
            ->except(['show']);

        // ============================================================
        // TESTIMONIAL MANAGEMENT
        // ============================================================
        Route::resource('testimonials', TestimonialManagementController::class)
            ->except(['show']);

        // ============================================================
        // CONTACT MESSAGES
        // ============================================================
        Route::prefix('messages')->name('messages.')->group(function () {
            Route::get('/', [ContactMessageController::class, 'index'])->name('index');
            Route::get('/{id}', [ContactMessageController::class, 'show'])->name('show');
            Route::put('/{id}/mark-replied', [ContactMessageController::class, 'markAsReplied'])->name('mark-replied');
            Route::delete('/{id}', [ContactMessageController::class, 'destroy'])->name('destroy');
        });

        // ============================================================
        // PAYMENT MANAGEMENT
        // ============================================================
        Route::prefix('payments')->name('payments.')->group(function () {
            Route::get('/', [PaymentController::class, 'index'])->name('index');
            Route::get('/{id}', [PaymentController::class, 'show'])->name('show');
            Route::put('/{id}/verify', [PaymentController::class, 'verify'])->name('verify');
            Route::put('/{id}/refund', [PaymentController::class, 'refund'])->name('refund');
        });

        // ============================================================
        // REPORTS
        // ============================================================
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/orders', [OrderReportController::class, 'orders'])->name('orders');
            Route::get('/sales', [OrderReportController::class, 'sales'])->name('sales');
            Route::get('/stock', [OrderReportController::class, 'stock'])->name('stock');
        });

        // ============================================================
        // ANALYTICS
        // ============================================================
        Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');

        // ============================================================
        // CHARTS
        // ============================================================
        Route::get('/charts', [ChartController::class, 'index'])->name('charts');
        Route::get('/charts/data', [ChartController::class, 'data'])->name('charts.data');

        // ============================================================
        // SUPER ADMIN ROUTES (Exclusive)
        // ============================================================
        Route::middleware(['role:super_admin'])
            ->prefix('super')
            ->name('super.')
            ->group(function () {

                // User Management
                Route::prefix('users')->name('users.')->group(function () {
                    Route::get('/', [UserManagementController::class, 'index'])->name('index');
                    Route::get('/create', [UserManagementController::class, 'create'])->name('create');
                    Route::post('/', [UserManagementController::class, 'store'])->name('store');
                    Route::get('/{id}/edit', [UserManagementController::class, 'edit'])->name('edit');
                    Route::put('/{id}', [UserManagementController::class, 'update'])->name('update');
                    Route::delete('/{id}', [UserManagementController::class, 'destroy'])->name('destroy');
                    Route::get('/{id}/toggle', [UserManagementController::class, 'toggleActive'])->name('toggle');
                });

                // Settings
                Route::prefix('settings')->name('settings.')->group(function () {
                    Route::get('/', [SettingController::class, 'index'])->name('index');
                    Route::get('/general', [SettingController::class, 'general'])->name('general');
                    Route::put('/general', [SettingController::class, 'updateGeneral'])->name('general.update');
                    Route::get('/payment', [SettingController::class, 'payment'])->name('payment');
                    Route::put('/payment', [SettingController::class, 'updatePayment'])->name('payment.update');
                    Route::get('/shipping', [SettingController::class, 'shipping'])->name('shipping');
                    Route::put('/shipping', [SettingController::class, 'updateShipping'])->name('shipping.update');
                });
            });
    });