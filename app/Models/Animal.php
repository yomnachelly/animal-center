<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model 
{
    protected $fillable = [
        'nom',
        'espece_id',
        'race_id',
        'age',
        'sexe',
        'etat_sante',
        'photo',
        'statut'
    ];

    public function espece()
    {
        return $this->belongsTo(Espece::class);
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }
    // AJOUTEZ CETTE RELATION
    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }
}
