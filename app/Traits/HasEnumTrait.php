<?php 

namespace App\Traits;

trait HasEnumtrait {
    static function getCasesArray(){
        $cases = [];
        foreach(self::cases() as $sk)
            array_push($cases, $sk->value);
        return $cases;
    }
}