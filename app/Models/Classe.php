<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = [
        'matiere_id',
        'enseignant_id',
        'trimestre_id',
        'niveau_id',
        'salle_id',
        'nom_classe',
        'capacite_max',
        'statut',
        'description'
    ];

    // Relations
    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }

    public function trimestre()
    {
        return $this->belongsTo(Trimestre::class);
    }

    public function niveauScolaire()
    {
        return $this->belongsTo(NiveauScolaire::class, 'niveau_id');
    }

    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }

    public function eleves()
    {
        return $this->belongsToMany(Eleve::class, 'eleve_classes')
                    ->withPivot('statut', 'date_inscription')
                    ->withTimestamps();
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function presences()
    {
        return $this->hasMany(Presence::class);
    }

    public function emploiTemps()
    {
        return $this->hasMany(EmploiTemps::class);
    }

    public function eleveClasses()
    {
        return $this->hasMany(EleveClasse::class);
    }

    // Scopes
    public function scopeEnCours($query)
    {
        return $query->where('statut', 'en_cours');
    }

    public function scopePlanifiee($query)
    {
        return $query->where('statut', 'planifiee');
    }
}