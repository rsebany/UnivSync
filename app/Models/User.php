<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'related_id',
        'related_type',
        'statut',
        'derniere_connexion',
        'avatar'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'derniere_connexion' => 'datetime',
        'password' => 'hashed',
    ];

    // Relations polymorphes
    public function relatedModel()
    {
        return $this->morphTo('related');
    }

    // Relations spécifiques
    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class, 'related_id')
                    ->where('related_type', Enseignant::class);
    }

    public function eleve()
    {
        return $this->belongsTo(Eleve::class, 'related_id')
                    ->where('related_type', Eleve::class);
    }

    public function tuteur()
    {
        return $this->belongsTo(Tuteur::class, 'related_id')
                    ->where('related_type', Tuteur::class);
    }

    // Scopes
    public function scopeAdmin($query)
    {
        return $query->where('user_type', 'admin');
    }

    public function scopeEnseignant($query)
    {
        return $query->where('user_type', 'enseignant');
    }

    public function scopeEleve($query)
    {
        return $query->where('user_type', 'eleve');
    }

    public function scopeTuteur($query)
    {
        return $query->where('user_type', 'tuteur');
    }

    public function scopeActif($query)
    {
        return $query->where('statut', 'actif');
    }

    // Méthodes utilitaires
    public function isAdmin()
    {
        return $this->user_type === 'admin';
    }

    public function isEnseignant()
    {
        return $this->user_type === 'enseignant';
    }

    public function isEleve()
    {
        return $this->user_type === 'eleve';
    }

    public function isTuteur()
    {
        return $this->user_type === 'tuteur';
    }

    public function updateLastLogin()
    {
        $this->update(['derniere_connexion' => now()]);
    }
}