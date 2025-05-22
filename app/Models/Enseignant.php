<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule',
        'prenom',
        'nom',
        'email',
        'telephone',
        'date_naissance',
        'genre',
        'adresse',
        'departement_id',
        'statut',
        'salaire',
        'date_embauche'
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'date_embauche' => 'date',
        'salaire' => 'decimal:2'
    ];

    // Relations
    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function classes()
    {
        return $this->hasMany(Classe::class);
    }

    public function departementsChef()
    {
        return $this->hasMany(Departement::class, 'chef_departement_id');
    }

    public function user()
    {
        return $this->morphOne(User::class, 'related');
    }

    // Accessors
    public function getNomCompletAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }

    public function getAgeAttribute()
    {
        return $this->date_naissance ? $this->date_naissance->age : null;
    }

    public function getAncienneteAttribute()
    {
        return $this->date_embauche ? $this->date_embauche->diffInYears(now()) : null;
    }

    // Scopes
    public function scopeActif($query)
    {
        return $query->where('statut', 'actif');
    }

    public function scopeParDepartement($query, $departementId)
    {
        return $query->where('departement_id', $departementId);
    }

    // Méthodes utilitaires
    public function estChefDepartement()
    {
        return $this->departementsChef()->exists();
    }

    public function getNombreClassesActuelles()
    {
        return $this->classes()->where('statut', 'en_cours')->count();
    }
}