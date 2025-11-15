<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rendezvous extends Model
{
    public function user()
{
    return $this->belongsTo(User::class);
}

public function animal()
{
    return $this->belongsTo(Animal::class);
}
public function soins()
{
    return $this->belongsToMany(Soin::class, 'rendezvous_soin');
}

public function vaccins()
{
    return $this->belongsToMany(Vaccin::class, 'rendezvous_vaccin');
}

}
