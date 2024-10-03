<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Electro extends Model
{
    use HasFactory;

    // Définit la clé primaire
    protected $primaryKey = 'id_electro';

    // Définit les champs pouvant être remplis en masse
    protected $fillable = [
        'type',
        'puissance',
        'duree',
        'consomation',
        'logement_id', // Clé étrangère associée à la table logements
    ];

    /**
     * Relation entre Electro et Logement.
     * Un electro appartient à un logement.
     */
    public function logement()
    {
        return $this->belongsTo(Logement::class, 'logement_id');
    }
}
