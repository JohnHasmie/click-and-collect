<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->get('/', function () {
    // return view('welcome');
    return view('auth.login');
});
Route::middleware(['guest'])->get('/login', function () {
    // return view('welcome');
    return view('auth.login');
})->name('login');
Route::middleware(['guest'])->get('/register', function () {
    // return view('welcome');
    return view('auth.register');
})->name('register');

Route::get('auth/google', [SocialController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialController::class, 'handleGoogleCallback']);

Route::get('auth/facebook', [SocialController::class, 'facebookRedirect']);
Route::get('auth/facebook/callback', [SocialController::class, 'loginWithFacebook']);

Route::middleware(['auth:sanctum', 'verified'])->get('products', 'ProductController@getAll')->name('products');
Route::middleware(['auth:sanctum', 'verified'])->get('product/{slug}/', 'ProductController@show')->name('product.show');
Route::middleware(['auth:sanctum', 'verified'])->post('product/add/cart', 'ProductController@addToCart')->name('product.add.cart');

Route::middleware(['auth:sanctum', 'verified'])->get('/cart', 'CartController@getCart')->name('checkout.cart');
Route::middleware(['auth:sanctum', 'verified'])->get('/cart/item/{id}/remove', 'CartController@removeItem')->name('checkout.cart.remove');
Route::middleware(['auth:sanctum', 'verified'])->get('/cart/clear', 'CartController@clearCart')->name('checkout.cart.clear');

Route::middleware(['auth:sanctum', 'verified'])->get('account/orders', 'AccountController@getOrders')->name('account.orders');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/checkout', 'CheckoutController@getCheckout')->name('checkout.index');
    Route::post('/checkout/order', 'CheckoutController@placeOrder')->name('checkout.place.order');
    Route::get('/checkout/payment/complete', 'CheckoutController@complete')->name('checkout.payment.complete');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');