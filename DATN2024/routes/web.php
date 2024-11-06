<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Payment\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Client\HomeController;

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
    dd(\Illuminate\Support\Facades\Auth::check());
   return view('welcome');
});

Route::get('/home', [HomeController::class, 'index']);
Route::get('product-detail/{slug}', [\App\Http\Controllers\Client\ProductController::class, 'productDetail'])
    ->name('product.detail');
Route::post('product/get-variant-details', [\App\Http\Controllers\Client\ProductController::class, 'getVariantDetails'])
    ->name('product.getVariantDetails');
Route::get('/check-stock/{productId}/{colorId}/{capacityId}', [\App\Http\Controllers\Client\ProductController::class, 'checkStock']);

Route::get('notfound', [App\Http\Controllers\Client\HomeController::class, 'notfound']);
Route::get('about', [App\Http\Controllers\Client\HomeController::class, 'about']);
Route::get('contact', [App\Http\Controllers\Client\HomeController::class, 'contact']);
Route::get('shop', [App\Http\Controllers\Client\HomeController::class, 'shop']);


Route::post('cart/add-to-cart', [\App\Http\Controllers\Client\CartController::class, 'addToCart'])
    ->name('cart.add-to-cart');
Route::get('cart/list', [\App\Http\Controllers\Client\CartController::class, 'cartList'])
    ->name('cart.list');

Route::post('cart/delete', [\App\Http\Controllers\Client\CartController::class, 'deleteCart'])
    ->name('cart.delete');

Route::post('cart/update', [\App\Http\Controllers\Client\CartController::class, 'updateCart'])
    ->name('cart.update');

// Auth
Route::get('/register', [RegisterController::class, 'showFormRegister'])->name('register.form');
Route::get('/login', [LoginController::class, 'showLogin']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Handle the form submission
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post("login",  [LoginController::class, 'login'])->name('login');

// Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
// Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword']);
// Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
//     ->name('password.reset');




Route::prefix('admin')
    ->as('admin.')

    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('products/pagination/', [ProductController::class, 'pagination'])->name('products.pagination');
        Route::get('products/search/', [ProductController::class, 'search'])->name('products.search');
        Route::get('products/filter', [ProductController::class, 'filter'])->name('products.filter');

        Route::resource('products', ProductController::class);
        Route::resource('catalogues', CatalogueController::class);
        Route::resource('tags', TagController::class);
    });















