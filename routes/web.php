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

Route::middleware(['auth:sanctum', 'guest'])->get('/', function () {
    // return view('welcome');
    return view('auth.login');
});
Route::middleware(['auth:sanctum', 'guest'])->get('/login', function () {
    // return view('welcome');
    return view('auth.login');
});
Route::middleware(['auth:sanctum', 'guest'])->get('/register', function () {
    // return view('welcome');
    return view('auth.register');
});

Route::get('auth/google', [SocialController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialController::class, 'handleGoogleCallback']);

Route::get('auth/facebook', [SocialController::class, 'facebookRedirect']);
Route::get('auth/facebook/callback', [SocialController::class, 'loginWithFacebook']);

Route::get('products', 'ProductController@getAll')->name('products');
Route::get('product/{slug}/', 'ProductController@show')->name('product.show');
Route::post('product/add/cart', 'ProductController@addToCart')->name('product.add.cart');

Route::get('/cart', 'CartController@getCart')->name('checkout.cart');
Route::get('/cart/item/{id}/remove', 'CartController@removeItem')->name('checkout.cart.remove');
Route::get('/cart/clear', 'CartController@clearCart')->name('checkout.cart.clear');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
