<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecurityAdvice extends Model
{
    protected $table = 'security_advices';


    protected $fillable = [
        'location_overview_id',
        'overall_safety_rating',
        'emergency_numbers',
        'areas_to_avoid',
        'common_scams',
        'safety_tips',
        'health_precautions'
    ];

    protected $casts = [
        'safety_tips' => 'array'
    ];



    public function locationOverview()
    {
        return $this->belongsTo(LocationOverview::class);
    }

    public function emergencyFacilities()
    {
        return $this->hasMany(EmergencyFacility::class);
    }
}
