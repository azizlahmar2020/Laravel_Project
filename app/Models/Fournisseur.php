<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'type',
        'tarif',
    ];
    public function conseils()
    {
        return $this->hasMany(ConseilE::class);
    }
}
