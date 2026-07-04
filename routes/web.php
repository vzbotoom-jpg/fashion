<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CollectionController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\AboutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

// ============================================================
// PUBLIC ROUTES - GUEST + CUSTOMER (Tidak perlu login)
// ============================================================

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Products
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/{slug}', [ProductController::class, 'show'])->name('show');
});

// Collections
Route::prefix('collections')->name('collections.')->group(function () {
    Route::get('/', [CollectionController::class, 'index'])->name('index');
    Route::get('/{slug}', [CollectionController::class, 'show'])->name('show');
});

// Gallery
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

// About
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Contact
Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('/', [ContactController::class, 'store'])->name('store');
});

// Privacy Policy & Terms
Route::get('/kebijakan-privasi', function () {
    return view('frontend.privacy');
})->name('privacy');

Route::get('/syarat-ketentuan', function () {
    return view('frontend.terms');
})->name('terms');

// ============================================================
// AUTH ROUTES
// ============================================================
require __DIR__ . '/auth.php';

// ============================================================
// CUSTOMER ROUTES (Login required - role:customer)
// ============================================================
require __DIR__ . '/customer.php';

// ============================================================
// ADMIN ROUTES (Login required - role:admin,super_admin)
// ============================================================
require __DIR__ . '/admin.php';

// ============================================================
// API ROUTES
// ============================================================
require __DIR__ . '/api.php';

// ============================================================
// FALLBACK ROUTE
// ============================================================
Route::fallback(function () {
    return redirect()->route('home');
});