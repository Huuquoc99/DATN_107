<?php

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
Route::get('register', [App\Http\Controllers\Client\HomeController::class, 'register']);
Route::get('login', [App\Http\Controllers\Client\HomeController::class, 'login'])->name('login');
Route::get('reset_password', [App\Http\Controllers\Client\HomeController::class, 'resetpassword']);
Route::get('checkout', [App\Http\Controllers\Client\HomeController::class, 'checkout']);
Route::get('confirm_password', [App\Http\Controllers\Client\HomeController::class, 'confirmpassword']);

Route::get('about', [App\Http\Controllers\Client\HomeController::class, 'about']);
Route::get('contact', [App\Http\Controllers\Client\HomeController::class, 'contact']);
Route::get('shop', [App\Http\Controllers\Client\HomeController::class, 'shop']);
