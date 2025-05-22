<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_eleve',
        'prenom',
        'nom',
        'date_naissance',
        'genre',
        'lieu_naissance',
        'email',
        'telephone',
        'adresse',
        'statut',
        'date_inscription',
        'photo'
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'date_inscription' => 'date'
    ];

    // Relations
    public function tuteurs()
    {
        return $this->belongsToMany(Tuteur::class, 'eleve_tuteurs')
                    ->withPivot('is_principal')
                    ->withTimestamps();
    }

    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'eleve_classes')
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

    public function niveauEleves()
    {
        return $this->hasMany(NiveauEleve::class);
    }

    public function eleveClasses()
    {
        return $this->hasMany(EleveClasse::class);
    }

    public function eleveTuteurs()
    {
        return $this->hasMany(EleveTuteur::class);
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

    public function getTuteurPrincipalAttribute()
    {
        return $this->tuteurs()->wherePivot('is_principal', true)->first();
    }

    // Scopes
    public function scopeActif($query)
    {
        return $query->where('statut', 'actif');
    }

    public function scopeParGenre($query, $genre)
    {
        return $query->where('genre', $genre);
    }

    public function scopeParNiveau($query, $niveauId)
    {
        return $query->whereHas('niveauEleves', function($q) use ($niveauId) {
            $q->where('niveau_id', $niveauId);
        });
    }

    // Méthodes utilitaires
    public function getMoyenneGenerale($periodeId = null)
    {
        $query = $this->evaluations()->with('typeEvaluation');
        
        if ($periodeId) {
            $query->where('periode_id', $periodeId);
        }
        
        $evaluations = $query->get();
        
        if ($evaluations->isEmpty()) {
            return null;
        }
        
        $totalNotes = 0;
        $totalCoefficients = 0;
        
        foreach ($evaluations as $evaluation) {
            $noteRamenee20 = ($evaluation->note / $evaluation->note_sur) * 20;
            $coefficient = $evaluation->typeEvaluation->coefficient ?? 1;
            
            $totalNotes += $noteRamenee20 * $coefficient;
            $totalCoefficients += $coefficient;
        }
        
        return $totalCoefficients > 0 ? round($totalNotes / $totalCoefficients, 2) : null;
    }

    public function getTauxPresence($periodeId = null)
    {
        $query = $this->presences();
        
        if ($periodeId) {
            $query->whereHas('classe.trimestre', function($q) use ($periodeId) {
                $q->where('id', $periodeId);
            });
        }
        
        $totalPresences = $query->count();
        $presencesEffectives = $query->where('statut', 'present')->count();
        
        return $totalPresences > 0 ? round(($presencesEffectives / $totalPresences) * 100, 2) : 0;
    }
}