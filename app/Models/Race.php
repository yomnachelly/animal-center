<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Race extends Model
{
    protected $fillable = ['nom', 'espece_id'];

    public function espece()
    {
        return $this->belongsTo(Espece::class);
    }
    public function animals(){
    return $this->hasMany(Animal::class);
}

}
