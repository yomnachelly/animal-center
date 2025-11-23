<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    use HasFactory;
     protected $table = 'rendezvous';
    protected $fillable = ['user_id','animal_id', 'date', 'etat'];

    public function soins()
    {
        return $this->belongsToMany(Soin::class, 'rendezvous_soin', 'rendezvous_id', 'soin_id');
    }

    public function vaccins()
    {
        return $this->belongsToMany(Vaccin::class, 'rendezvous_vaccin', 'rendezvous_id', 'vaccin_id');
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}