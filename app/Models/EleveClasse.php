<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EleveClasse extends Model
{
    use HasFactory;

    protected $fillable = [
        'eleve_id',
        'classe_id',
        'statut',
        'date_inscription'
    ];

    protected $casts = [
        'date_inscription' => 'date'
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
    public function scopeInscrit($query)
    {
        return $query->where('statut', 'inscrit');
    }
}