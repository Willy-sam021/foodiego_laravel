<?php

namespace App\Enums;
use App\Traits\HasEnumtrait;
enum DeliveryEnums:string
{
    use HasEnumtrait;
    case INTRANSIT = "in transit";
    case PENDING = "pending";
    case DELIVERED = "delivered";
}
