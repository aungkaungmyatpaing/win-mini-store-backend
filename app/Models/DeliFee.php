<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'region_id', 'city', 'fee'
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'id')->withTrashed();
    }
}
