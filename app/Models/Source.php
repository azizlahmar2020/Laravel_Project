<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_renouv',
        'desc_renouv',
        'puissMax_renouv',
        'date_renouv',
        'typeE_renouv',
        'prodEstime_renouv',
        'coutInstall_renouv',
        'impactCO2_renouv',
        'proprio_renouv'
    ];
    public function owner()
    {
        return $this->belongsTo(User::class, 'proprio_renouv');
    }
    
    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }
    
}
