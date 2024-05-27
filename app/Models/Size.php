<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $guarded = ['id'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sizes')->withPivot('product_id','english_name','myanmar_name');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
