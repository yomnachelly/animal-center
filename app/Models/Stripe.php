<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stripe extends Model
{
    use HasFactory;

    // Spécifier le nom de la table
    protected $table = 'stripe';

    protected $fillable = [
        'hebergement_id',
        'stripe_session_id',
        'stripe_payment_intent_id',
        'stripe_customer_id',
        'customer_email',
        'montant_dt',
        'montant_usd',
        'taux_change',
        'nombre_jours',
        'frais_jour',
        'statut',
        'metadata',
        'paid_at'
    ];

    protected $casts = [
        'metadata' => 'array',
        'paid_at' => 'datetime',
        'montant_dt' => 'decimal:2',
        'montant_usd' => 'decimal:2',
        'taux_change' => 'decimal:4',
        'frais_jour' => 'decimal:2',
    ];

    public function hebergement()
    {
        return $this->belongsTo(Hebergement::class);
    }
} 