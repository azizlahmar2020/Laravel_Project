<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transport extends Model
{
    use HasFactory;
    protected $fillable = [
        'consommateur',
        'type', // Type de transport (e.g., voiture, vélo)
        'distance', // Distance parcourue
        'emissions_CO2', // Émissions de CO2
        'cost', // Cost of the transport
        'duration', // Duration of the transport
    ];
    public function owner()
    {
        return $this->belongsTo(User::class, 'consommateur'); // 'consommateur' est la clé étrangère dans la table factures
    }
}
