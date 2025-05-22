<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trimestre extends Model
{
    use HasFactory;

    protected $fillable = [
        'annee_id',
        'numero_trimestre',
        'nom_trimestre',
        'date_debut',
        'date_fin'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date'
    ];

    // Relations
    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class, 'annee_id');
    }

    public function classes()
    {
        return $this->hasMany(Classe::class);
    }

    // Scopes
    public function scopeEnCours($query)
    {
        $today = now()->toDateString();
        return $query->whereDate('date_debut', '<=', $today)
                    ->whereDate('date_fin', '>=', $today);
    }
}