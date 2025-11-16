<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    protected $fillable = ['user_id', 'animal_id', 'etat'];

    protected $casts = [
        'etat' => 'string',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function animal() { return $this->belongsTo(Animal::class); }
}

