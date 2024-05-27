<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DeliFeeController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PaymentController;
use App\Http\Controllers\Backend\PointController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\RegionController;
use App\Http\Controllers\Backend\SizeController;
use App\Http\Controllers\Backend\CurrencyController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\OrderDetailController;
use App\Http\Controllers\Backend\PaymentAccountController;
use App\Http\Controllers\Backend\TownshipController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('/dashboard', function () {
    return view('backend.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/lang/{lang}', function ($lang){
    app()->setLocale($lang);
    session()->put('locale', $lang);

    return redirect()->back();
})->name('lang');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('/profile/edit',[AuthController::class,'profileEdit'])->name('admin.edit');
    Route::put('/profile/update',[AuthController::class,'profileUpdate'])->name('admin.update');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resources([
        'brands' => BrandController::class,
        'categories' => CategoryController::class,
        'colors' => ColorController::class,
        'sizes' => SizeController::class,
        'products' => ProductController::class,
        'points' => PointController::class,
        'regions' => RegionController::class,
        'deli-fees' => DeliFeeController::class,
        'payments' => PaymentController::class,
        'customer' => CustomerController::class,
        'township' => TownshipController::class,
        'payment-accounts' => PaymentAccountController::class
    ]);
    Route::get('product-images/{product}', [ProductController::class, 'images']);

    /** Currency */
    Route::get('/currency',[CurrencyController::class,'index'])->name('currency.index');
    Route::post('/currency',[CurrencyController::class,'editOrUpdate'])->name('currency.editOrUpdate');


    //order
    // Route::get('/orders', [OrderController::class, 'index'])->name('order');
    // Route::get('/orders/status/{status}', [OrderController::class, 'orderByStatus'])->name('orderByStatus');

    // Route::post('/orders/{order}', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
    // Route::get('/orders/cancel/{order}', [OrderController::class, 'cancelOrder'])->name('order.cancel');
    // Route::post('/orders/cancel/{order}', [OrderController::class, 'saveCancelOrder'])->name('order.saveCancel');

    // Route::get('/orders/refund/all', [OrderController::class, 'refundOrderList'])->name('order.refund.list');
    // Route::get('/orders/refund/{order}', [OrderController::class, 'refundOrder'])->name('order.refund');
    // Route::post('/orders/refund/{order}', [OrderController::class, 'saveRefundOrder'])->name('order.saveRefund');

    // Route::get('/orders/{order}/{notiId?}', [OrderController::class, 'detail'])->name('order.detail');

    // Route::get('/all-orders/datatable/ssd', [OrderController::class, 'getAllOrder']);
    // Route::get('/refund-orders/datatable/ssd', [OrderController::class, 'getRefundList']);
    // Route::get('/orders/{status}/datatable/ssd', [OrderController::class, 'getOrderByStatus']);

    //whole Sale ajax
    Route::post('/whole-sale/update', [ProductController::class, 'wholeSlaeUpdate']);
    Route::post('/orders/{id}/confirm', [OrderDetailController::class, 'orderConfirm']);
    Route::post('/orders/{id}/cancel', [OrderDetailController::class, 'orderCancel']);
    Route::post('/orders/{id}/deliver', [OrderDetailController::class, 'orderDeliver']);
    Route::post('/orders/{id}/complete', [OrderDetailController::class, 'orderComplete']);

    Route::get('/orders/pending',[OrderDetailController::class,'index'])->name('pending-order.index');
    Route::get('/orders/confirm',[OrderDetailController::class,'confirmIndex'])->name('confirm-order.index');
    Route::get('/orders/deliver',[OrderDetailController::class,'deliverIndex'])->name('deliver-order.index');
    Route::get('/orders/complete',[OrderDetailController::class,'completeIndex'])->name('complete-order.index');
    Route::get('/orders/cancel',[OrderDetailController::class,'cancelIndex'])->name('cancel-order.index');

    Route::get('/orders/{id}/order-detail',[OrderDetailController::class,'orderDetail'])->name('order-detail');
    Route::post('/customer/{id}/ban', [CustomerController::class, 'banUser']);

});
