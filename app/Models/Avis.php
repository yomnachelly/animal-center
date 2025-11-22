<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'texte',
    ];

    // Active automatiquement les timestamps (created_at et updated_at)
    public $timestamps = true;

    // Indique que created_at et updated_at sont des objets Carbon
    protected $dates = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
