<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;


Route::middleware(['auth','orderPage'])->group(function(){
Route::get('checkout',[OrderController::class, 'index'])->name('checkout');
Route::post('place-order',[OrderController::class, 'placeOrder'])->name('place-order');
Route::get('order-conf',[OrderController::class, 'orderConfirmation'])->name('orderConfirmation');

});



?>
