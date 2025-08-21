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

    Route::get('/seller/order',[OrderController::class,'getOrders'])->name('seller.orders');


});


