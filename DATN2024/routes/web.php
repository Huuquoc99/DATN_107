<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\PaymentMethodControlller;
use App\Http\Controllers\Admin\ProductCapacityController;
use App\Http\Controllers\Admin\ProductColorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StatusOrderController;
use App\Http\Controllers\Admin\StatusPaymentController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('home', [App\Http\Controllers\Client\HomeController::class, 'index'])->name('home');
Route::get('login', [App\Http\Controllers\Client\HomeController::class, 'login']);

Route::get('register', [App\Http\Controllers\Client\HomeController::class, 'register']);
Route::get('login', [App\Http\Controllers\Client\HomeController::class, 'login'])->name('login');
Route::get('reset_password', [App\Http\Controllers\Client\HomeController::class, 'resetpassword']);
Route::get('checkout', [App\Http\Controllers\Client\HomeController::class, 'checkout']);

Route::get('notfound', [App\Http\Controllers\Client\HomeController::class, 'notfound']);
Route::get('about', [App\Http\Controllers\Client\HomeController::class, 'about']);
Route::get('contact', [App\Http\Controllers\Client\HomeController::class, 'contact']);
Route::get('shop', [App\Http\Controllers\Client\HomeController::class, 'shop']);
Route::get('cart', [App\Http\Controllers\Client\HomeController::class, 'cart']);
Route::get('product-detail', [App\Http\Controllers\Client\HomeController::class, 'productdetail']);




Route::prefix('admin')
    ->as('admin.')

    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Product
        Route::get('products/pagination/', [ProductController::class, 'pagination'])->name('products.pagination');
        Route::get('products/search/', [ProductController::class, 'search'])->name('products.search');
        Route::resource('products', ProductController::class);
        // Other
        Route::resource('catalogues', CatalogueController::class);
        Route::resource('banners', BannerController::class);
        Route::resource('paymentMethods', PaymentMethodControlller::class);
        Route::resource('productCapacities', ProductCapacityController::class);
        Route::resource('productColors', ProductColorController::class);
        Route::resource('statusOrders', StatusOrderController::class);
        Route::resource('statusPayments', StatusPaymentController::class);
        Route::resource('customers', UserController::class);
        // Customer
        Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/user/{id}/update', [UserController::class, 'update'])->name('user.update');


    });












