<?php

namespace App\Models;

use App\Casts\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // protected $casts = [
    //     'image' => Image::class,
    // ];

    public function product()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
