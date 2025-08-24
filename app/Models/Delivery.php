<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'status',
        'delivery_note',
        'delivered_at',
        'exp_delivery_date'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order(){
         return $this->belongsTo(Order::class, 'order_id');
    }

}
