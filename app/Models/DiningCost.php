<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiningCost extends Model
{
    protected $fillable = ['category', 'cost_range', 'cost_id'];

    public function cost()
    {
        return $this->belongsTo(Cost::class);
    }
}
