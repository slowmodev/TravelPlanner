<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoricalEventAndLandmark extends Model
{

    protected $table = 'historical_events_and_landmarks';

    protected $fillable = ['name', 'description', 'location_overview_id'];

    public function locationOverview()
    {
        return $this->belongsTo(LocationOverview::class);
    }
}
