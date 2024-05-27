<?php

namespace App\Models;

use App\Casts\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_logo', 'name'
    ];

    // protected $casts = [
    //     'payment_logo' => Image::class,
    // ];
    public function paymentAccounts()
    {
        return $this->hasMany(PaymentAccount::class);
    }
}
