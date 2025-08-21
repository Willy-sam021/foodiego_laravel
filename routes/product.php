<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;



//products
Route::middleware(['auth'])->group(function (){
    Route::get('/products',[ProductController::class,'index'])->name('products');
    Route::get('/product/detail/{id}',[ProductController::class,'productDetail'])->name('productDetail');

});

//product seller routes
Route::middleware(['auth', 'seller'])->group(function () {
    Route::get('/product-create',[ProductController::class,'create'])->name('product.create');
    Route::post('/product-store',[ProductController::class,'store'])->name('product.store');

});

//filter by category

Route::post('category/filter',[ProductController::class, 'filterByCategory'])->name('categoryFilter');
