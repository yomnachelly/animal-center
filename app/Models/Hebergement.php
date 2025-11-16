<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hebergement extends Model
{
    protected $fillable = ['user_id', 'animal_id', 'date_debut', 'date_fin', 'frais', 'demande_id'];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'frais' => 'decimal:2',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function animal() { return $this->belongsTo(Animal::class); }
    public function demande() { return $this->belongsTo(Demande::class); }
}
