<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Espece extends Model
{
    protected $fillable = ['nom'];

    public function races()
    {
        return $this->hasMany(Race::class);
    }

    // AJOUTEZ CETTE RELATION MANQUANTE
    public function animaux()
    {
        return $this->hasMany(Animal::class);
    }
}