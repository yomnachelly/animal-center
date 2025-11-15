<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationApp extends Model
{
    use HasFactory;

    protected $table = 'notifications_app'; // nom de la table

    protected $fillable = [
        'user_id',
        'contenu',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
