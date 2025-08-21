<?php

namespace App\Models;
use App\Models\Category;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'slug',
        'description',
        'price_per_kg',
        'available_weight',
        'image',
        'category_id',
        'is_active',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function seller()
    {
    return $this->belongsTo(User::class, 'user_id');
    }

   
public function cart(){
        return $this->hasOne(Cart::class);
    }


// SCOPES
    public function scopeActive($query){
        return $query->where('status', true);

    }

    public function scopePriceAbove($query, $amount)
{
    return $query->where('price', '>', $amount);
}


}
