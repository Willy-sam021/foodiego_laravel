<?php

namespace App\Enums;
use App\Traits\HasEnumtrait;
enum PaymentStatusEnums:string{
use HasEnumtrait;

    case SUCCESSFUL = "successful";
    case FAILED = "failed";
}
