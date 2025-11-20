<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaiementHebergement extends Model
{
    use HasFactory;

    protected $table = 'paiements_hebergements';

    protected $fillable = [
        'hebergement_id',
        'frais_par_jour',
        'date_paiement',
        'status_paiement'
    ];

    protected $dates = ['date_paiement'];

    // Relation inverse avec l'hébergement
    public function hebergement()
    {
        return $this->belongsTo(Hebergement::class);
    }
}
