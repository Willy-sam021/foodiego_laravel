<?php
use Illuminate\Support\Facades\Auth;

function currentAuthUser()
    {
        if(Auth::guard('admin')->check()){
            return auth('admin')->user();
        }elseif(Auth::guard('seller')->check()){
            return auth('seller')->user();
        }else{
            return Auth::guard('web')->user();
        }

    }

function orderId(){
    return session('order_id') ?? null;
}




?>
