<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripDetail extends Model
{
    protected $fillable = [
        'reference_code',
        'location',
        'duration',
        'traveler',
        'budget',
        'activities',
        'location_overview_id'
    ];

    public function locationOverview()
    {
        return $this->belongsTo(LocationOverview::class);
    }
}
