<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    protected $fillable = ['user_id', 'animal_id', 'etat'];

    protected $casts = [
        'etat' => 'string',
    ];

   
   
     // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec l'animal
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function hebergement()
{
    return $this->hasOne(Hebergement::class, 'demande_id');
}
    public function adoption()
    {
        return $this->hasOne(Adoption::class, 'demande_id');
    }

}

