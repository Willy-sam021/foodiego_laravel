<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

//cart
Route::middleware(['auth'])->group(function () {
    Route::get('/cart',[CartController::class,'index'])->name('cart');
    Route::post('/cart/add',[CartController::class,'add'])->name('cart.add');
    Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::post('/cart/delete',[CartController::class, 'deleteCart'])->name('cart.delete');
});



