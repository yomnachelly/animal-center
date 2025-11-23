<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soin extends Model
{
    protected $fillable = ['nom', 'frais', 'vet_id'];

    public function rendezvous()
    {
        return $this->hasMany(Rendezvous::class);
    }

    public function vet()
    {
        return $this->belongsTo(User::class, 'vet_id');
    }
}