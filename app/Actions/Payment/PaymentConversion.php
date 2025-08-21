<?php
namespace App\Actions\Payment;
Use App\Models\Payment;
use App\Enums\CurrencyEnums;

class PaymentConversion{
public $amount;
   public function __construct($data)
   {
        switch($data['currency']){
            case CurrencyEnums::NGN->value:
            $this->amount = $this->convertNaira($data);
            break;
        }
   }


   public function convertNaira($data){
    $amount = $data['amount'];
    $calcAmt = $amount / 100;
    return $calcAmt;
   }

   public function amount(){
    if($this->amount){
        return $this->amount;
    }
   }
}

?>
