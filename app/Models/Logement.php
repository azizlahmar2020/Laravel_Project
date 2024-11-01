<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logement extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'type',
        'superficie',
        'nbr_habitant'
    ];
}
