<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/userdashboard',function(){
        return view('user.userDashboard');
        })->name('user.dashboard');

    
});
