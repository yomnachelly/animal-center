<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = [
        'nom',
        'espece',
        'age',
        'sexe',
        'etat_sante',
        'photo',
        'statut',
        'race'
    ];

    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }

    public function rendezvous()
    {
        return $this->hasMany(Rendezvous::class);
    }

    public function adoptions()
    {
        return $this->hasMany(Adoption::class);
    }
}
