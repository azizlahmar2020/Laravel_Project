<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class energy_consumption extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'electricity_consumption',
        'gas_consumption',
        'heating_oil_consumption',
        'solar_energy_generated',
        'period',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carbon_footprint()
    {
        return $this->hasOne(carbon_footprint::class);
    }
}
