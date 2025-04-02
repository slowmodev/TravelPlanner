<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'name',
        'address',
        'price_per_night',
        'rating',
        'description',
        'coordinates',
        'image_url',
    ];
}
