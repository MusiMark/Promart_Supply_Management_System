<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;


//Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Handle login submission
Route::post('/login', [LoginController::class , 'authenticate' ] );

// Handle logout
Route::post('/logout', [LoginController::class , 'logout' ] )->name('logout');


/*
* Customer Interface
*/

//Home Page
Route::get('/', function () {
    return view('customer.home');
})->name('home');

//Products Page
Route::get('/products/{category}/{sub_category}', [App\Http\Controllers\ProductController::class, 'index']);
Route::get('/products/{category}', [App\Http\Controllers\ProductController::class, 'index2']);
Route::get('/products/{category}/{sub_category}/{product_id}', [App\Http\Controllers\ProductController::class, 'productDetails']);

//Search
Route::get('/search', [App\Http\Controllers\ProductController::class, 'search'])->name('products.search');
Route::get('/autocomplete', [App\Http\Controllers\ProductController::class, 'autocomplete'])->name('products.autocomplete');




//Cart Page
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/count', [App\Http\Controllers\CartController::class, 'cartCount'])->name('cart.count');

//Checkout
Route::get('/cart/checkout', [App\Http\Controllers\CartController::class, 'checkoutIndex'])->name('checkout');
Route::post('/cart/checkout/process', [App\Http\Controllers\CartController::class, 'checkoutProcess'])->name('checkout.process');
Route::get('/cart/confirmation', function () { return view('customer.confirmation');})->name('confirmation');

//Paymeny Gateway
Route::get('/payment', [App\Http\Controllers\CartController::class, 'paymentGatewayView'])->name('payment');
Route::post('/payment/process', [App\Http\Controllers\CartController::class, 'paymentGatewayProcess'])->name('paymentProcess');


//Profile
Route::get('/profile', function () {
    return view('customer.profile');
})->name('profile');
