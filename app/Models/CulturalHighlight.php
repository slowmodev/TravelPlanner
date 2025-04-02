<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CulturalHighlight extends Model
{
    protected $table = 'cultural_highlights';
    protected $fillable = ['name', 'description', 'location_overview_id'];

    public function locationOverview()
    {
        return $this->belongsTo(LocationOverview::class);
    }
}
