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
    public function owner()
    {
        return $this->belongsTo(User::class, 'consommateur'); // 'consommateur' est la clé étrangère dans la table factures
    }
    public function sources()
    {
        return $this->hasMany(Source::class);
    }
    public function updateWithSource(Source $source)
    {
        // Mettre à jour l'émission de carbone en soustrayant l'impact de la source
        $this->emission_carbone -= $source->impactCO2_renouv;

        // Ajouter le coût d'installation de la source au montant total de la facture
        $this->montant_totale += $source->coutInstall_renouv;

        // Enregistrer les changements
        $this->save();
    }

    
}
