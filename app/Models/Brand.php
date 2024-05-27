<?php

namespace App\Models;

use App\Casts\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $guarded = [];

    // protected $casts = [
    //     'image' => Image::class,
    // ];
}
