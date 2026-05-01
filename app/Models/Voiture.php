<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voiture extends Model
{
    protected $table = 'table_voiture';

    protected $fillable = [
        'marque',
        'modele',
        'annee',
        'couleur',
        'path_image',
        'kilometrage',
        'prix_jour',
        'statut',
    ];

    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}
