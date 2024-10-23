<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    // Define the table name (optional if it follows Laravel naming conventions)
    protected $table = 'factures';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'consommateur',
        'date_facture',
        'periode_facture',
        'consommation_totale',
        'prix_unitaire',
        'montant_totale',
        'type_energie',
        'emission_carbone',
        'moyen_paiement',
        'statut'
    ];

    public function sources()
    {
        return $this->hasMany(Source::class);
    }
}
