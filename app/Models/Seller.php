<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $fillable =[
        "user_id",
        "business_name",
        "government_nin",
        "business_address",
        "business_type",
        "bank_account_details",
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
