<?php
namespace App\Actions\Payment;

use Illuminate\Support\Facades\Http;

class PaymentPaystack{

    public static function verify($reference){
       return  Http::withToken(config('services.payment.payment_secret_key'))
            ->acceptJson()
            ->get("https://api.paystack.co/transaction/verify/{$reference}");
    }

    public static function initialize($url, $fields){
       return Http::withToken(config('services.payment.payment_secret_key'))
            ->acceptJson()
            ->post($url, $fields);
    }
}

?>
