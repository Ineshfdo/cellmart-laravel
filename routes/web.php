<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (No Authentication Required)
|--------------------------------------------------------------------------
*/

Route::get('/', [ProductsController::class, 'index'])->name('home');
Route::get('/products', [ProductsController::class, 'allProducts'])->name('products.index');
Route::get('/products/{id}', [ProductsController::class, 'show'])->name('products.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Google OAuth Routes
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);

/*
|--------------------------------------------------------------------------
| Authenticated User Routes (Cart & Checkout)
|--------------------------------------------------------------------------
| These routes require the user to be logged in via Jetstream/Sanctum
*/

Route::middleware(['auth:sanctum', config('jetstream.auth_session')])->group(function () {
    // User Profile
    Route::get('/user/profile', function () {
        return view('profile.show');
    })->name('profile.show');
    
    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    
    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('/checkout/success/{orderId}', [CheckoutController::class, 'success'])->name('checkout.success');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| These routes require authentication and admin privileges
*/

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'admin'])->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Admin routes with prefix
    Route::prefix('admin')->name('admin.')->group(function () {
        // Product Management
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
        
        // Order Management
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        
        // Customer Management
        Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
        
        // User Management
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
    });
});