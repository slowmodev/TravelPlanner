<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    protected $fillable = ['day'];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
