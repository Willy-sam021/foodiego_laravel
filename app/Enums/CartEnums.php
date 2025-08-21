<?php
namespace App\Enums;
use App\Traits\HasEnumtrait;
enum CartEnums:string
{
    use HasEnumtrait;

    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case PURCHASED = 'purchased';
}
?>
