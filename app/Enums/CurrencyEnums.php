<?php
namespace App\Enums;
use App\Traits\HasEnumtrait;
enum CurrencyEnums:string
{
    use HasEnumtrait;
    case NGN ='NGN';
    case USD = 'USD';
    case EUR = 'EUR';


}
?>
