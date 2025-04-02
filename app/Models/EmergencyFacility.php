<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmergencyFacility extends Model
{
    protected $fillable = [
        'security_advice_id',
        'name',
        'address',
        'phone'
    ];

    public function securityAdvice()
    {
        return $this->belongsTo(SecurityAdvice::class);
    }
}
