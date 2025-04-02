<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    protected $fillable = ['day', 'location_overview_id'];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
