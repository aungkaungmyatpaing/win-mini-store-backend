<?php

namespace App\Models;

use App\Casts\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;

    // protected $casts = [
    //     'payment_photo' => Image::class,
    //     'refund_image' => Image::class,
    // ];

    protected $fillable = [
        'customer_id', 'payment_id', 'payment_photo', 'payment_method', 'name', 'phone', 'address',
        'grand_total', 'status', 'refund_date', 'cancel_message', 'refund_message', 'refund_image',
        'region_id',
        'deli_fee_id',
        'delivery_fee',
        'sub_total',
    ];

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }



    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }







}
