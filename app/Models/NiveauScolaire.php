<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NiveauScolaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_niveau',
        'ordre_niveau',
        'description'
    ];

    // Relations
    public function classes()
    {
        return $this->hasMany(Classe::class, 'niveau_id');
    }

    public function niveauEleves()
    {
        return $this->hasMany(NiveauEleve::class, 'niveau_id');
    }

    // Scopes
    public function scopeOrdered($query)
    {
        return $query->orderBy('ordre_niveau');
    }
}