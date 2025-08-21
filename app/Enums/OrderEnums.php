<?php

namespace App\Enums;
use App\Traits\HasEnumtrait;
enum OrderEnums:string
{
    use HasEnumtrait;
    case PENDING = "pending";
    case PROCESSING = "processing";
    case CANCELLED = "cancelled";
    case CONFIRMED = "confirmed";
    case DELIVERED = "delivered";
    case SHIPPED = "shipped";
    case OUT_FOR_DELIVERY = "out for delivery";
}
