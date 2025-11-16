<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
    protected $fillable = ['user_id', 'animal_id', 'date','demande_id'];

    protected $casts = [
        'date' => 'date',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function animal() { return $this->belongsTo(Animal::class); }
    public function demande() { return $this->belongsTo(Demande::class); }
}

