<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Auth\Admin\AdminLoginController;
use App\Http\Controllers\Payment\MomoPaymentController;
use App\Http\Controllers\Payment\VnpayPaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\TrashedController;
use App\Http\Controllers\Auth\RegisterController;
// use App\Http\Controllers\Admin\CatalogueController;

use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Admin\StatusOrderController;
use App\Http\Controllers\Admin\ProductColorController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\StatusPaymentController;
use App\Http\Controllers\Auth\ForgotPasswordController;

use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\ProductCapacityController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('product-detail/{slug}', [\App\Http\Controllers\Client\ProductController::class, 'productDetail'])
    ->name('product.detail');
Route::post('product/get-variant-details', [\App\Http\Controllers\Client\ProductController::class, 'getVariantDetails'])
    ->name('product.getVariantDetails');
Route::get('/check-stock/{productId}/{colorId}/{capacityId}', [\App\Http\Controllers\Client\ProductController::class, 'checkStock']);

Route::get('notfound', [App\Http\Controllers\Client\HomeController::class, 'notfound'])->name('notfound');
Route::get('about', [App\Http\Controllers\Client\HomeController::class, 'about'])->name('about');
Route::get('contact', [App\Http\Controllers\Client\HomeController::class, 'contact'])->name('contact');
Route::get('shop', [App\Http\Controllers\Client\HomeController::class, 'shop'])->name('shop');


Route::prefix('cart')->name('cart.')->group(function () {
    Route::post('add-to-cart',  [CartController::class, 'addToCart'])->name('add-to-cart');
    Route::get('list',          [CartController::class, 'cartList'])->name('list');
    Route::post('delete',       [CartController::class, 'deleteCart'])->name('delete');
    Route::post('update',       [CartController::class, 'updateCart'])->name('update');
});



Route::middleware('auth')->group(function () {

    // Chekcout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    // Route::get('/checkout/success', function () {
    //     return view('client.success');
    // })->name('checkout.success');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

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


});

Route::post('/vnpay-payment',   [VnpayPaymentController::class, 'vnpayPayment'])->name('payment.vnpay');
Route::post('/momo-payment',    [MomoPaymentController::class, 'momoPayment'])->name('payment.momo');


// Auth
Route::get('/register', [RegisterController::class, 'showFormRegister'])->name('register.form');
Route::get('/login', [LoginController::class, 'showLogin']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Handle the form submission
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post("login",  [LoginController::class, 'login'])->name('login');


Route::get('/forgot-password', function () {
    return view('client.auth.forgot-password');
})->middleware('guest')->name('forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->middleware('guest')->name('forgot-password');
Route::get('/reset-password', [ForgotPasswordController::class, 'showResetForm ']);

Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->middleware('guest')->name('reset-password');





Route::prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::get('login', [AdminLoginController::class, 'showLoginForm'])->middleware('guest');
        Route::post('login', [AdminLoginController::class, 'login'])->name('login');
        Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');
    })

//    ->middleware(['checkAdminMiddleware'])
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');


        // Product
        Route::get('products/pagination/', [ProductController::class, 'pagination'])->name('products.pagination');
        Route::get('products/search/', [ProductController::class, 'search'])->name('products.search');
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

    });
    // });














