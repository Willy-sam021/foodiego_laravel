<?php

namespace App\Enums;
use App\Traits\HasEnumtrait;
enum PaymentGatewayEnums:string
{
    use HasEnumtrait;
    case PAYSTACK = 'paystack';
    case PAYPAL ='paypal';
}
