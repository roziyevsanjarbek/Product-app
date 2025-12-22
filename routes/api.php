<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [AuthController::class, 'index']);
    Route::get('/user/get', [AuthController::class, 'getUsers']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('update');
    Route::get('/user/{id}', [AuthController::class, 'show']);
    Route::post('/user', [AuthController::class, 'addUser']);
    Route::post('/user/{id}', [AuthController::class, 'updateUser']);
    Route::delete('/user/{id}', [AuthController::class, 'deleteUser']);


    Route::get('/products', [ProductController::class, 'index']);
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
    Route::post('/sales/restore/{id}', [SalesController::class, 'restore']);



    Route::get('/all/product-history/', [HistoryController::class, 'allHistoryByProduct']);
    Route::get('/all/sale-history/', [HistoryController::class, 'allHistoryBySale']);
    Route::get('/all/user-history', [HistoryController::class, 'allHistoryByUser']);
    Route::get('/sale-history-search-date', [HistoryController::class, 'saleHistorySearchDate']);
    Route::get('/product-history-search-date', [HistoryController::class, 'productHistorySearchDate']);
    Route::get('/user-history-search-date', [HistoryController::class, 'userHistorySearchDate']);
    Route::get('/sale-search-action', [HistoryController::class, 'saleSearchAction']);
    Route::get('/product-search-action', [HistoryController::class, 'productSearchAction']);
    Route::get('/user-search-action', [HistoryController::class, 'userSearchAction']);
    Route::get('/history/{userId}', [HistoryController::class, 'history']);
    Route::get('/product/history/{userId}/{productId}', [HistoryController::class, 'productHistoryById']);
    Route::get('/sales/history/{userId}/{saleId}', [HistoryController::class, 'getSaleIdByUserId']);


});

