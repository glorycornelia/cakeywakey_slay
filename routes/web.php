<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CakeController;
use App\Http\Controllers\CustomizeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;

// Login Page
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Routes for home and admin pages
Route::middleware('auth')->group(function () {
    // User home page
    Route::get('/home', function () {
        return view('home'); // User home page
    })->name('home');

    // Admin home page
    Route::get('/admin', function () {
        return view('admin'); // Admin home page
    })->name('admin');
});

// Admin Page
Route::get('/admin', [AdminController::class, 'index'])->name('admin');

// Register Page
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Home Page
Route::get('/home', [CakeController::class, 'index'])->name('home');
Route::post('/home/add-to-cart', [CakeController::class, 'addToCart'])->name('cart.addToCart'); 

// Order Page
Route::get('/order', [CustomizeController::class, 'index'])->name('order');
Route::post('/order/store', [CustomizeController::class, 'store'])->name('order.store');

// Cart Page
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/cart/remove/{cartItemId}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/process', [CartController::class, 'process'])->name('cart.process');

// Payment Routes
Route::get('/order/payment/{order}', [PaymentController::class, 'pay'])->name('payment.pay');
Route::post('/order/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
Route::get('/cart/success', function () {
    return view('cart.success');
})->name('cart.success');