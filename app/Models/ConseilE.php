<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConseilE extends Model
{
    use HasFactory;
    protected $table = 'conseils'; // Spécifiez le nom de la table ici
    protected $fillable = [
        'description',
        'economies',
        'fournisseur_id', // Add this line

    ];
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
}
