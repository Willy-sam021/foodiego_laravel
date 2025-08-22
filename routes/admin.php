<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Route::get('admin-register',[AdminController::class, 'index']);
Route::post('admin-register',[AdminController::class, 'createAdmin'])->name('adminRegister');

Route::get('admin-login',[AdminController::class, 'create'])->name('adminLoginPage');
Route::post('admin-login',[AdminController::class, 'login'])->name('adminLogin');


Route::middleware(['auth:admin'])->group(function () {
    Route::get('admin-dashboard',[AdminController::class, 'viewDashBoard'])->name('adminDashBoard');

});






?>
