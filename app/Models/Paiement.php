<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    // Nom de la table
    protected $table = 'paiement';

    // La clé primaire est 'id' par défaut, et auto-incrémentée
    protected $primaryKey = 'id';
    public $incrementing = true;

    // Si ta table n'a pas les colonnes created_at / updated_at
    public $timestamps = false;

    // Les colonnes qui peuvent être remplies via create() ou fill()
    protected $fillable = [
        'frais_jour',
    ];
}
