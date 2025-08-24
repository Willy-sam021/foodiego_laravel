<?php

namespace App\Models;
use App\Models\Seller;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable  implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function seller(){
       return $this->hasOne(Seller::class);
    }

    public function order(){
       return $this->hasMany(Order::class);
    }

    public function payments() {
    return $this->hasMany(Payment::class);
}

public function products()
{
    return $this->hasMany(Product::class);
}

public function deliveries()
{
    return $this->hasMany(Delivery::class);
}

public function cart(){
    return $this->hasMany(Cart::class);
}

public function scopeBuyer($query)
{
    return $query->where('is_seller', false);
}

public function scopeAllSellers($query)
{
    return $query->where('is_seller', true);
}

}
