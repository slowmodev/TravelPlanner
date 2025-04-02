<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationOverview extends Model
{
    protected $fillable = [
        'history_and_culture',
        'local_customs_and_traditions',
        'geographic_features_and_climate',
    ];

    public function historicalEventsAndLandmarks()
    {
        return $this->hasMany(HistoricalEventAndLandmark::class);
    }

    public function culturalHighlights()
    {
        return $this->hasMany(CulturalHighlight::class);
    }
}
