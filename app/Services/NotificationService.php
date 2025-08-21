<?php
namespace App\Services;
use App\Mail\SellerRegistrationMail;
use App\Mail\userLoginMail;
use Illuminate\Support\Facades\Mail;
class NotificationService {

    public function userLoginMail(){

    }

    public function sellerRegistratioMail($seller){
        Mail::to($seller->user->email)->queue(new SellerRegistrationMail($seller));
    }
}
?>
