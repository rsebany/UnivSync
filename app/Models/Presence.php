<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    protected $fillable = [
        'eleve_id',
        'classe_id',
        'date_cours',
        'statut',
        'heure_arrivee',
        'justification'
    ];

    protected $casts = [
        'date_cours' => 'date',
        'heure_arrivee' => 'datetime:H:i'
    ];

    // Relations
    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    // Scopes
    public function scopePresent($query)
    {
        return $query->where('statut', 'present');
    }

    public function scopeAbsent($query)
    {
        return $query->whereIn('statut', ['absent', 'absent_justifie']);
    }

    public function scopeRetard($query)
    {
        return $query->where('statut', 'retard');
    }

    public function scopeParPeriode($query, $dateDebut, $dateFin)
    {
        return $query->whereBetween('date_cours', [$dateDebut, $dateFin]);
    }
}