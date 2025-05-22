<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnneeScolaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_annee',
        'date_debut',
        'date_fin',
        'is_active'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'is_active' => 'boolean'
    ];

    // Relations
    public function trimestres()
    {
        return $this->hasMany(Trimestre::class, 'annee_id');
    }

    public function niveauEleves()
    {
        return $this->hasMany(NiveauEleve::class, 'annee_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}