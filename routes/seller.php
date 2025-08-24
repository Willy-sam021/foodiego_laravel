<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\IsSeller as seller;

Route::middleware(['auth'])->group(function (){
Route::get("/seller-register",[SellerController::class,"create"])->name("seller.register");
Route::post('/seller-register',[SellerController::class,"store"])->name('seller.register.store');
});


Route::middleware(['auth','seller'])->group(function () {
    Route::get('/sellerdashboard', function () {
        return view('seller.sellerDashboard');
    })->name('seller.dashboard');

    Route::get('seller/order',[SellerController::class,'getOrders'])->name('seller.orders');
    Route::get('seller-order-details/{order}',[SellerController::class,'getOrderdetail'])->name('sellerOrderDetails');
    Route::post('seller-delivery-date/{order}',[SellerController::class,'setDeliveryDate'])->name('setDeliveryDate');
    Route::put('delivery-complete/{delivery?}',[SellerController::class,'deliveryComplete'])->name('deliveryComplete');


});


