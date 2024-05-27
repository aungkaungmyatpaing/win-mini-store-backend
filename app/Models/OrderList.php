<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'order_detail_id',
        'product_id',
        'color_id',
        'size_id',
        'redeem',
        'price',
        'quantity',
        'total_price',
    ];

    /**
     * Get the customer that owns the order list.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the order detail that owns the order list.
     */
    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class);
    }

    /**
     * Get the product associated with the order list.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
