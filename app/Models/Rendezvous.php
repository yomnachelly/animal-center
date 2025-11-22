<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rendezvous extends Model
{

    // Indiquer explicitement le nom de la table
    protected $table = 'rendezvous';
     use HasFactory;

    protected $fillable = [
        'user_id',      // ← AJOUTEZ CETTE LIGNE
        'animal_id',
        'date', 
        'etat'
    ];
 // Cast la date en objet Carbon
    protected $casts = [
        'date' => 'date'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function soins()
    {
        return $this->belongsToMany(Soin::class, 'rendezvous_soin');
    }

    public function vaccins()
    {
        return $this->belongsToMany(Vaccin::class, 'rendezvous_vaccin');
    }
}
