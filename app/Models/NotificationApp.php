<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationApp extends Model
{
    use HasFactory;

    protected $table = 'notifications_app';

    protected $fillable = [
        'id_expediteur',
        'id_destinataire',
        'contenu',
        'date',
    ];
    protected $casts = [
    'date' => 'datetime', // transforme automatiquement en Carbon
];

    // L'utilisateur qui envoie
    public function expediteur()
    {
        return $this->belongsTo(User::class, 'id_expediteur');
    }

    // L'utilisateur qui reçoit
    public function destinataire()
    {
        return $this->belongsTo(User::class, 'id_destinataire');
    }
}
