<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'name',
    //     'category_id',
    //     'brand_id',
    //     'name',
    //     'description',
    //     'price',
    //     'instock',
    //     'redeemable',
    // ];

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function image()
    {
        return $this->hasOne(ProductImage::class, 'product_id', 'id')->latestOfMany();
    }

    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }

    public function scopeInstock($query)
    {
        return $query->where('instock', '1');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_colors');
    }

    public function productColors()
    {
        return $this->hasManyThrough(Color::class, ProductColor::class, 'product_id', 'id', 'id', 'color_id');
    }

    public function productSizes()
    {
        return $this->hasManyThrough(Size::class, ProductSize::class, 'product_id', 'id', 'id', 'size_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes');
    }

    public function wholeSaleProducts()
    {
        return $this->hasMany(WholeSaleProduct::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderLists()
    {
        return $this->hasMany(OrderList::class);
    }
}
