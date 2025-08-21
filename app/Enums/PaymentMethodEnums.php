<?php
namespace App\Enums;
use App\Traits\HasEnumtrait;
enum PaymentMethodEnums:string{
    use HasEnumtrait;

    case CARD = "cash";
    case CASH = "paystack";
}

?>
