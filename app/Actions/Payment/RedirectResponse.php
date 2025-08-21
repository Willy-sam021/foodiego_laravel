<?php
namespace App\Actions\Payment;

class RedirectResponse{

    public static function paymentRedirect($view){
       return   response()
            ->view($view)
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
}
?>
