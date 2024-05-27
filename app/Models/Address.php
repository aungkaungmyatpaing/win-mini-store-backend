<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'address',
        'name',
        'phone',
        'township_id',
        'address_type',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function township()
    {
        return $this->belongsTo(Township::class);
    }
}
