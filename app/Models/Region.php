<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'cod','name_mm'
    ];

    public function deliveryFee()
    {
        return $this->hasMany(DeliFee::class, 'region_id', 'id');
    }

    public function townships()
    {
        return $this->hasMany(Township::class);
    }
}
