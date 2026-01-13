<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/getAllProducts', [ProductController::class, 'getAll']);
/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (SANCTUM)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', fn (Request $request) => $request->user());

    // Products
    Route::get('/getProducts', [ProductController::class, 'index']);
    Route::post('/insertProducts', [ProductController::class, 'store']);
    Route::put('/updateProducts/{id}', [ProductController::class, 'update']);
    Route::delete('/deleteProducts/{id}', [ProductController::class, 'destroy']);

    // Users (ADMIN ONLY)
    Route::delete('/deleteUser/{id}', [UserController::class, 'destroy']);

    // Orders
    Route::post('/checkout', [OrderController::class, 'store']);
    Route::delete('/deleteOrder/{id}', [OrderController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| WEB LOGIC ROUTES (Moved from web.php)
|--------------------------------------------------------------------------
| These routes handle form submissions from the website but are placed here
| to separate Views (web.php) from Actions (api.php).
| Uses 'web' middleware to maintain Session/Auth state.
*/
Route::middleware(['web', 'auth:sanctum', config('jetstream.auth_session')])->group(function () {
    // Feedback
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

    // Cart Actions
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{key}', [CartController::class, 'remove'])->name('cart.remove')->where('key', '.*');

    // Checkout (Web Session Based) - URI modified to avoid conflict with API /checkout
    Route::post('/checkout/process', [CheckoutController::class, 'store'])->name('checkout.store');
});

// Admin Actions (Require Admin Middleware)
Route::middleware(['web', 'auth:sanctum', config('jetstream.auth_session'), 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Product Management (CRUD)
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::put('/products/{id}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [AdminProductController::class, 'destroy'])->name('products.destroy');

    // Order Management
    Route::post('/orders/{id}/accept', [AdminOrderController::class, 'accept'])->name('orders.accept');
    Route::delete('/orders/{id}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');

    // Customer Management
    Route::delete('/customers/{id}', [AdminCustomerController::class, 'destroy'])->name('customers.destroy');

    // User Management
    Route::post('/users/{id}/toggle-type', [AdminUserController::class, 'toggleType'])->name('users.toggleType');
});
