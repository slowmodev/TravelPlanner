<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionalInformation extends Model
{
    protected $fillable = [
        'local_currency',
        'exchange_rate',
        'timezone',
        'weather_forecast',
        'transportation_options',
    ];
}
