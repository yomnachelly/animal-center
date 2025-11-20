<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PaiementHebergement;

class Hebergement extends Model
{
    use HasFactory;

    protected $table = 'hebergements';

    protected $fillable = [
        'demande_id',
        'animal_id',
        'user_id',
        'date_debut',
        'date_fin'
    ];

    protected $dates = ['date_debut', 'date_fin'];

    // Relation avec l'animal
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le paiement
    public function paiement()
    {
        return $this->hasOne(PaiementHebergement::class);
    }

    // Calcul dynamique du total
    public function getTotalFraisAttribute()
    {
        if ($this->paiement) {
            $jours = $this->date_debut->diffInDays($this->date_fin);
            return $jours * $this->paiement->frais_par_jour;
        }
        return 0;
    }
}
