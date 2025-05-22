<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploiTemps extends Model
{
    use HasFactory;

    protected $fillable = [
        'classe_id',
        'jour_semaine',
        'heure_debut',
        'heure_fin'
    ];

    protected $casts = [
        'heure_debut' => 'datetime:H:i',
        'heure_fin' => 'datetime:H:i'
    ];

    // Relations
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    // Scopes
    public function scopeParJour($query, $jour)
    {
        return $query->where('jour_semaine', $jour);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('heure_debut');
    }
}