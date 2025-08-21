<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id', 'order_id', 'payment_reference','payment_method', 'amount', 'currency', 'payment_status','paid_at'
    ];

    public function user() {
    return $this->belongsTo(User::class);
}

public function order() {
    return $this->belongsTo(Order::class);
}

}
