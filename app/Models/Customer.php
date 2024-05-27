<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Laravel\Passport\HasApiTokens;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;

    // protected $fillable = [
    //     'name',
    //     'phone',
    //     'email',
    //     'password',
    //     'is_banned',
    //     'fcm_token_key',
    // ];

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function order()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function points()
    {
        return $this->hasOne(CustomerPoint::class, 'customer_id', 'id');
    }

    public function fcmTokenKey()
    {
        return $this->hasMany(FcmTokenKey::class, 'customer_id', 'id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function address()
    {
        return $this->hasMany(Address::class);
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
