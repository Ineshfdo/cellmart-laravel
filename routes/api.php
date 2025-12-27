<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrderController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

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

    // Orders (ADMIN ONLY)
    Route::delete('/deleteOrder/{id}', [OrderController::class, 'destroy']);
});
