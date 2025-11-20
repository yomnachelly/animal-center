<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',      // AJOUTER
        'telephone', // AJOUTER  
        'adresse',   // AJOUTER
        'verrouiller'// ajouter ici
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function demandes()
{
    return $this->hasMany(Demande::class);
}

public function rendezvous()
{
    return $this->hasMany(Rendezvous::class);
}

// Notifications reçues
public function notificationsReceived()
{
    return $this->hasMany(\App\Models\NotificationApp::class, 'id_destinataire');
}

// Notifications envoyées
public function notificationsSent()
{
    return $this->hasMany(\App\Models\NotificationApp::class, 'id_expediteur');
}


public function avis()
{
    return $this->hasMany(Avis::class);
}
public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isVet()
    {
        return $this->role === 'vet';
    }

    public function isClient()
    {
        return $this->role === 'client';
    }
    public function soins()
{
    return $this->hasMany(Soin::class, 'vet_id');
}

public function vaccins()
{
    return $this->hasMany(Vaccin::class, 'vet_id');
}

}
