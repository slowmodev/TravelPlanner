<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransportationCost extends Model
{
    protected $fillable = ['type', 'cost', 'cost_id', 'location_overview_id'];

    public function cost()
    {
        return $this->belongsTo(Cost::class);
    }
}
