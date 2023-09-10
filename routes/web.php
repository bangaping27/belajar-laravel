<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//------------------ 1. Daftar/Login ------------------//
//=================== LOGIN ==========================//
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
//-----------------------------------------------------//

//------------------ 2. Dashboard ---------------------//
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//-----------------------------------------------------//

//------------------ 3. product --------------------------//
Route::get('/add-product',[ProductController::class, 'create'])->name('add-product');
Route::post('/add-product', [ProductController::class, 'store'])->name('product.create');
Route::get('/checkout/{product}',[PaymentController::class, 'checkout'])->name('checkout');
Route::post('/checkout/{product}',[PaymentController::class, 'processPayment'])->name('checkout.process');

