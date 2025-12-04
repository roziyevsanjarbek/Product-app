<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [AuthController::class, 'index']);
    Route::get('/users/get', [AuthController::class, 'getUsers']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('update');
    Route::get('/user/{id}', [AuthController::class, 'show']);
    Route::post('/user', [AuthController::class, 'addUser']);
    Route::post('/user/{id}', [AuthController::class, 'updateUser']);
    Route::delete('/user/{id}', [AuthController::class, 'deleteUser']);


    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/history/{user_id}', [ProductController::class, 'productHistory']);
    Route::get('/product/price', [ProductController::class, 'getPriceByName']);
    Route::get('/product', [ProductController::class, 'show']);
    Route::post('/product', [ProductController::class, 'store']);
    Route::post('/products/update-price-and-add', [ProductController::class, 'updatePriceAndAdd']);
    Route::post('/products/force-create', [ProductController::class, 'forceCreate']);


    Route::post('/product/{id}', [ProductController::class, 'update']);
    Route::delete('/product/{id}', [ProductController::class, 'destroy']);

    Route::get('/sales', [SalesController::class, 'index']);
    Route::get('/sale', [SalesController::class, 'show']);
    Route::post('/sales', [SalesController::class, 'store']);
    Route::post('/sales/{id}', [SalesController::class, 'update']);
    Route::delete('/sales/{id}', [SalesController::class, 'destroy']);



});

