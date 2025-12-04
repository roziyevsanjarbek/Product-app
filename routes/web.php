<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//Route::get('/admin/dashboard', [HomeController::class, 'index']);
//Route::get('/user/dashboard', [HomeController::class, 'userDashboard']);


Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
Route::get('/super-logout', [HomeController::class, 'superLogout'])->name('logout');
Route::get('/user-logout', [HomeController::class, 'userLogout'])->name('userLogout');

Route::get('/super/dashboard', [HomeController::class, 'superDashboard'])->name('superDashboard');
Route::get('/super/products', [HomeController::class, 'superProducts'])->name('superProducts');
Route::get('/super/sold', [HomeController::class, 'superSold'])->name('superSold');
Route::get('/super/users', [HomeController::class, 'superUsers'])->name('superUsers');
Route::get('/super/profile', [HomeController::class, 'superProfile'])->name('superProfile');


Route::get('/admin/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/admin/products', [HomeController::class, 'products'])->name('products');
Route::get('/admin/sold', [HomeController::class, 'sold'])->name('sold');
Route::get('/admin/users', [HomeController::class, 'users'])->name('users');
Route::get('/admin/profile', [HomeController::class, 'profile'])->name('profile');


Route::get('/user/dashboard', [HomeController::class, 'userDashboard'])->name('userDashboard');
Route::get('/user/products', [HomeController::class, 'userProducts'])->name('userProducts');
Route::get('/user/sold', [HomeController::class, 'userSold'])->name('userSold');
Route::get('/user/profile', [HomeController::class, 'userProfile'])->name('userProfile');
