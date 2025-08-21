<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;


Route::middleware(['auth','orderPage'])->group(function(){
    Route::get('payment',[PaymentController::class, 'index'])->name('paymentPaystack');
    Route::get('/payment/transaction',[PaymentController::class,'callback'])->name('paymentVerify');
    Route::post('/payment/initialize',[PaymentController::class,'paymentInitialize'])->name('paymentInitialize');
});




?>
