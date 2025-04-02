<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $fillable = ['total_cost', 'currency', 'location_overview_id'];

    public function transportationCosts()
    {
        return $this->hasMany(TransportationCost::class);
    }

    public function diningCosts()
    {
        return $this->hasMany(DiningCost::class);
    }
}
