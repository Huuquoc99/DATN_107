<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TrashedController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Admin\StatusOrderController;
use App\Http\Controllers\Client\ClientUserController;
use App\Http\Controllers\Admin\ProductColorController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\StatusPaymentController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Payment\MomoPaymentController;
use App\Http\Controllers\Payment\VnpayPaymentController;
use App\Http\Controllers\Admin\ProductCapacityController;
use App\Http\Controllers\Auth\Admin\AdminLoginController;
use App\Http\Controllers\Auth\Admin\AdminResetPasswordController;
use App\Http\Controllers\Auth\Admin\AdminForgotPasswordController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

// use App\Http\Controllers\Admin\PaymentMethodController;

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
    //Route::get('/', function () {
    //    dd(\Illuminate\Support\Facades\Auth::check());
    //   return view('welcome');
    //});


    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/catalogue/{id}/product',  [HomeController::class, 'productByCatalogue'])->name('catalogue.product');
    Route::post('/search',  [HomeController::class, 'search'])->name('product.search');
    Route::get('product-detail/{slug}', [\App\Http\Controllers\Client\ProductController::class, 'productDetail'])
        ->name('product.detail');
    Route::post('product/get-variant-details', [\App\Http\Controllers\Client\ProductController::class, 'getVariantDetails'])
        ->name('product.getVariantDetails');
    Route::get('/check-stock/{productId}/{colorId}/{capacityId}', [\App\Http\Controllers\Client\ProductController::class, 'checkStock']);
Route::post('/search',  [HomeController::class, 'search'])->name('product.search');


    Route::get('notfound',  [HomeController::class, 'notfound'])    ->name('notfound');
    Route::get('about',     [HomeController::class, 'about'])       ->name('about');
    Route::get('contact',   [HomeController::class, 'contact'])     ->name('contact');
    Route::get('shop',      [HomeController::class, 'shop'])->name('shop');


Route::prefix('cart')->name('cart.')->group(function () {
    Route::post('add-to-cart',  [CartController::class, 'addToCart'])->name('add-to-cart');
    Route::get('list',          [CartController::class, 'cartList'])->name('list');
    Route::post('delete',       [CartController::class, 'deleteCart'])->name('delete');
    Route::post('update-cart-quantity', [CartController::class, 'updateQuantity'])->name('update-cart-quantity');

});

// VnPay Payment
Route::get('vnpay-return', [CheckoutController::class, 'vnpayReturn'])->name('checkout.vnpayReturn');


Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

Route::get('order/districts/{provinceId}', [CheckoutController::class, 'getDistricts']);
Route::get('order/wards/{districtId}', [CheckoutController::class, 'getWards']);


Route::post('/guest-checkout', [CheckoutController::class, 'processCheckoutForGuests'])->name('guest-checkout.process');
Route::get('/guest-checkout/success', [CheckoutController::class, 'success'])->name('guest-checkout.success');
Route::get('/guest-checkout/fail', [CheckoutController::class, 'fail'])->name('guest-checkout.failed');

Route::middleware('auth')->group(function () {

    // Checkout
//    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/fail', [CheckoutController::class, 'fail'])->name('checkout.failed');

    // Order
    Route::get('/account/orders', [App\Http\Controllers\Client\OrderController::class, 'index'])->name('history');
    Route::get('/account/orders/{order}', [App\Http\Controllers\Client\OrderController::class, 'show'])->name('account.orders.show');
    Route::post('/account/orders/{orderId}/update-status', [OrderController::class, 'updateStatus'])->name('account.orders.updateStatus');
    Route::post('/account/orders/{id}/cancel', [OrderController::class, 'cancelOrder'])->name('account.orders.cancel');
    Route::post('/account/orders/{order}/mark-as-received', [OrderController::class, 'markAsReceived'])->name('account.orders.markAsReceived');

    // Comment
    Route::get('comments', [CommentController::class, 'index']);
    Route::put('comments/{id}', [CommentController::class, 'edit']);
    Route::delete('comments/{id}', [CommentController::class, 'destroy']);
    Route::post('products/{product_id}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Account
    Route::get('/account/dashboard', [LoginController::class, 'dashboard'])->name('account.dashboard');
    Route::get('/account/detail', [ClientUserController::class, 'accountDetail'])->name('accountdetail');
    Route::put('account/{id}/update-profile', [ClientUserController::class, 'updateProfile'])->name('account.updateProfile');
    Route::get('/account/change-password', [ClientUserController::class, 'showChangePasswordForm'])->name('account.changePassword');
    Route::put('account/change-password/{id}', [ClientUserController::class, 'changePassword'])->name('account.updatePassword');
    Route::put('account/{id}/update-avatar', [ClientUserController::class, 'updateAvatar'])->name('account.updateAvatar');

});

    // Auth
    Route::get('/register', [RegisterController::class, 'showFormRegister'])->name('register.form');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::get('/login', [LoginController::class, 'showLogin']);
    Route::post("login",  [LoginController::class, 'login'])->name('login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Forgot password
    Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    // Reset password
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('client.passwords.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

    Route::prefix('admin')
        ->as('admin.')
        ->group(function () {

            Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
            Route::post('login', [AdminLoginController::class, 'login'])->name('login');
            Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');
            
            Route::get('password/reset', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
            Route::post('password/email', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
            Route::get('password/reset/{token}', [AdminForgotPasswordController::class, 'showResetForm'])->name('password.reset');
            Route::post('password/reset', [AdminForgotPasswordController::class, 'reset'])->name('password.update');
        })

        ->middleware(['checkAdminMiddleware'])
        ->group(function () {

            // Dashboard
            Route::get('/dashboard', [DashboardController::class, 'statistics'])->name('dashboard');
            Route::get('/', [DashboardController::class, 'statistics'])->name('dashboard');

            // Product
            Route::get('products/filter', [ProductController::class, 'filter'])->name('products.filter');
            Route::resource('products', ProductController::class);
            
            // Other resources
            Route::resource('catalogues', CatalogueController::class);
            Route::resource('tags', TagController::class);
            Route::resource('banners', BannerController::class);
            Route::resource('paymentMethods', PaymentMethodController::class);
            Route::resource('productCapacities', ProductCapacityController::class);
            Route::resource('productColors', ProductColorController::class);
            Route::resource('statusOrders', StatusOrderController::class);
            Route::resource('statusPayments', StatusPaymentController::class);
            Route::resource('customers', UserController::class);
            Route::resource('comments', CommentController::class);


            // Customer
            Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
            Route::post('/user/{id}/update', [UserController::class, 'update'])->name('user.update');

            // Trashed
            Route::get('/trashed', [TrashedController::class, 'trashed'])->name('trashed');
            Route::post('/trashed/{id}/restore', [TrashedController::class, 'restore'])->name('restore');

            // Orders
            Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
            Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
            Route::post('orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

            // Invoice
            Route::get('/invoices', [InvoiceController::class, 'getInvoices'])->name('invoices.index');
            Route::get('/invoices/{id}', [InvoiceController::class, 'showInvoice'])->name('invoices.show');

            // Account
            Route::get('/account/{id}/edit', [AccountController::class, 'edit'])->name('account.edit');
            Route::put('account/{id}/update-profile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');
            Route::put('account/{id}/update-avatar', [AccountController::class, 'updateAvatar'])->name('account.updateAvatar');
            Route::put('account/{id}/change-password', [AccountController::class, 'changePassword'])->name('account.changePassword');
        });














