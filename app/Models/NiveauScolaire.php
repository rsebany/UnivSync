<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NiveauScolaire extends Model
{
    use HasFactory;

    protected $table = 'niveau_scolaires';

    protected $fillable = [
        'nom_niveau',
        'ordre_niveau',
        'description',
    ];

    protected $casts = [
        'ordre_niveau' => 'integer',
    ];

    // Relations
    public function niveauEleves(): HasMany
    {
        return $this->hasMany(NiveauEleve::class, 'niveau_id');
    }

    public function classes(): HasMany
    {
        return $this->hasMany(Classe::class, 'niveau_id');
    }

    public function eleves()
    {
        return $this->belongsToMany(Eleve::class, 'niveau_eleves', 'niveau_id', 'eleve_id')
                    ->withPivot(['annee_id', 'moyenne_generale', 'rang_classe', 'statut'])
                    ->withTimestamps();
    }

    // Scopes
    public function scopeOrdered($query)
    {
        return $query->orderBy('ordre_niveau');
    }

    // Accessors
    public function getEleveCountAttribute()
    {
        return $this->niveauEleves()->count();
    }
}