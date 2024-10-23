<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carbon_footprint extends Model
{
    use HasFactory;

    protected $fillable = [
        'energy_consumption_id',
        'electricity_carbon_emission',
        'gas_carbon_emission',
        'water_carbon_emission',
        'heating_oil_carbon_emission',
        'total_carbon_footprint',
        'carbon_saving',
        'calculation_date',
    ];

    public function energy_consumption()
    {
        return $this->belongsTo(energy_consumption::class);
    }
}
