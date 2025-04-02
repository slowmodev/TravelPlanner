<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name',
        'description',
        'coordinates',
        'address',
        'cost',
        'duration',
        'best_time',
        'itinerary_id',
    ];

    public function itinerary()
    {
        return $this->belongsTo(Itinerary::class);
    }
}
