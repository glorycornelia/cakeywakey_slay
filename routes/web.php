<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CakeController;
use App\Http\Controllers\CustomizeController;
use App\Http\Controllers\CartController;

// Login Page
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

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
Route::get('/cart/confirmation', [CartController::class, 'confirmation'])->name('cart.confirmation');

