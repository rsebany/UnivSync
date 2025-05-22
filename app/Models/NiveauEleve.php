<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NiveauEleve extends Model
{
    use HasFactory;

    protected $fillable = [
        'eleve_id',
        'niveau_id',
        'annee_id',
        'moyenne_generale',
        'rang_classe',
        'total_eleves_classe',
        'decision'
    ];

    protected $casts = [
        'moyenne_generale' => 'decimal:2'
    ];

    // Relations
    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }

    public function niveauScolaire()
    {
        return $this->belongsTo(NiveauScolaire::class, 'niveau_id');
    }

    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class, 'annee_id');
    }

    // Scopes
    public function scopeAdmis($query)
    {
        return $query->where('decision', 'admis');
    }

    public function scopeRedoublant($query)
    {
        return $query->where('decision', 'redouble');
    }
}