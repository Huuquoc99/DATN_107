<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CatalogueController;
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
   return view('welcome');
});

Route::get('/home', [HomeController::class, 'index']);


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
        Route::resource('products', ProductController::class);
        Route::resource('catalogues', CatalogueController::class);
    });














