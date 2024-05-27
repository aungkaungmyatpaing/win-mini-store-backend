<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'address_id',
        'cod',
        'payment_account_id',
        'total',
        'grand_total',
        'order_time_exchange_rate',
        'grand_total_exchange',
        'total_point',
        'status',
        'note',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function paymentAccount()
    {
        return $this->belongsTo(PaymentAccount::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderLists()
    {
        return $this->hasMany(OrderList::class);
    }
}
