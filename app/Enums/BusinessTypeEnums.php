<?php
namespace App\Enums;
use App\Traits\HasEnumtrait;
enum BusinessTypeEnums:string{
    use HasEnumtrait;

    case INDIVIDUAL ="individual";
    case COMPANY = "company";
}
?>
