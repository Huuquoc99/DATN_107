<?php

use App\Models\ProductColor;
use Illuminate\Http\Request;
use App\Models\ProductCapacity;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Foundation\Bootstrap\RegisterProviders;
use App\Http\Controllers\Auth\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth
    Route::post("register", [RegisterController::class, 'register']);
    Route::post("login", action: [LoginController::class, 'login']);
    Route::post("logout", [LogoutController::class, 'logout'])->middleware("auth:sanctum");
    Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
    Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword']);
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');

// Admin
    Route::middleware(['auth:sanctum', 'checkAdminMiddleware'])->group(function () {
        Route::apiResource("admin/user", UserController::class);
        Route::apiResource("admin/catalogue", CatalogueController::class);
        Route::apiResource("admin/producCapacity", ProductCapacity::class);
        Route::apiResource("admin/productColor", ProductColor::class);
    });