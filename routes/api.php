<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\DeliveryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/cart/add-to-cart',[CartController::class,'addToCart']);
    Route::get('/carts',[CartController::class,'getCarts']);
    Route::put('/cart/{id}/update',[CartController::class,'updateCart']);
    Route::delete('/cart/{id}/delete', [CartController::class, 'deleteCart']);
    Route::post('/address',[AuthController::class,'createAddress']);
    Route::put('/address/{id}/update',[AuthController::class,'updateAddress']);
    Route::get('/address',[AuthController::class,'getAddress']);

    Route::get('/checkout-preview', [CheckoutController::class, 'checkoutPreview']);
    Route::post('/checkout', [CheckoutController::class, 'checkout']);

    Route::get('/order-histories', [OrderController::class, 'getOrderHistories']);
    Route::get('/order-history/{id}/detail', [OrderController::class, 'getOrderDetail']);


});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/products', [ProductController::class, 'getProducts']);
Route::get('/product/{id}/detail',[ProductController::class, 'getProductDetail']);

Route::get('/categories', [ProductController::class, 'getCategories']);

Route::get('/brands', [ProductController::class, 'getBrands']);

Route::get('/delivery/regions',[DeliveryController::class,'getRegions']);
Route::get('/delivery/{id}/townships',[DeliveryController::class,'getTownships']);

Route::get('/payments',[DeliveryController::class,'getPayments']);
Route::get('/payments/{id}/accounts',[DeliveryController::class,'getPaymentAccounts']);

