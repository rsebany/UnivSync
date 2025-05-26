<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    use HasFactory;

    protected $table = 'eleve';
    protected $fillable = [
        'numero_eleve', 'prenom', 'deuxieme_prenom', 'nom', 'date_naissance', 
        'lieu_naissance', 'genre', 'date_inscription', 'adresse', 'telephone', 
        'email', 'photo_url', 'statut', 'allergies', 'problemes_medicaux'
    ];

    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'eleve_classe', 'id_eleve', 'id_classe')
                    ->withPivot('statut')
                    ->withTimestamps();
    }

    public function niveaux()
    {
        return $this->belongsToMany(NiveauScolaire::class, 'niveau_eleve', 'id_eleve', 'id_niveau')
                    ->withPivot('id_annee', 'moyenne_generale', 'rang_classe', 'statut')
                    ->withTimestamps();
    }

    public function tuteurs()
    {
        return $this->belongsToMany(Tuteur::class, 'eleve_tuteur', 'id_eleve', 'id_tuteur')
                    ->withPivot('id_type_tuteur', 'is_contact_urgence', 'priorite_contact')
                    ->withTimestamps();
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'id_eleve');
    }

    public function presences()
    {
        return $this->hasMany(Presence::class, 'id_eleve');
    }

    public function getFullNameAttribute()
    {
        return "{$this->prenom} {$this->nom}";
    }
}