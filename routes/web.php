<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\SertifikatController;
use App\Models\Materi;

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
Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/remove/satu/{id}', [CartController::class, 'removeFromCartSatu'])->name('cart.remove.satu');
Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::get('/retrieve-fpc/{fpcId}', [PaymentController::class, 'retrieveFPC'])->name('retrieveFPC');
Route::get('/checkout/{product}',[PaymentController::class, 'checkout'])->name('checkout');
Route::post('/checkout/{product}',[PaymentController::class, 'processPayment'])->name('checkout.process');
//-----------------------------------------------------//

//------------------ 4. Payment --------------------------//
Route::get('/create-virtual-account', [PaymentController::class, 'showCreateForm']);
Route::post('/create-virtual-account', [PaymentController::class, 'createVirtualAccount'])->name('createVirtualAccount');

Route::get('/simulate-payment', [PaymentController::class, 'showSimulatePaymentForm'])->name('showSimulatePaymentForm');
Route::post('/simulate-payment', [PaymentController::class, 'simulatePayment'])->name('simulatePayment');

//-----------------------------------------------------//
Route::get('academies', [MateriController::class, 'index'])->name('materi.index');

//--------------------------------------------------------
Route::get('/materi/create',[MateriController::class, 'create'])->name('materi.create');
Route::post('/materi', [MateriController::class, 'store'])->name('materi.store');

Route::get('/materi/{materi}/sub-materi/create',[MateriController::class, 'createsubmateri'])->name('sub-materi.create');
Route::post('/materi/{materi}/sub-materi', [MateriController::class, 'storesubmateri'])->name('sub-materi.store');

Route::get('/sub-materi/{subMateri}/isi/create',[MateriController::class, 'createisi'])->name('isi.create');
Route::post('/sub-materi/{subMateri}/isi', [MateriController::class, 'storeisi'])->name('isi.store');

Route::get('/materi/{materi}',[MateriController::class, 'show'])->name('materi.show');
Route::get('isi-submateri/{isiSubMateri}', [MateriController::class, 'showSubMateri'])->name('isi.show');

Route::get('sertifikat', [SertifikatController::class, 'index'])->name('sertifikat.index');
Route::post('/buat',[SertifikatController::class, 'prosess'])->name('sertifikat.create');

Route::get('/verifikasi', [SertifikatController::class, 'showVerificationPage'])->name('sertifikat.verifikasi');
Route::post('/verifikasi', [SertifikatController::class, 'verifyCertificate'])->name('sertifikat.verify');


