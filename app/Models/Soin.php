<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soin extends Model
{
    protected $fillable = ['nom', 'frais'];

    public function rendezvous()
    {
        return $this->hasMany(Rendezvous::class);
    }
}

