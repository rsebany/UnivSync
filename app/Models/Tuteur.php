<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuteur extends Model
{
    use HasFactory;

    protected $fillable = [
        'prenom',
        'nom',
        'email',
        'telephone',
        'adresse',
        'profession',
        'lien_parente',
        'type_tuteur_id'
    ];

    // Relations
    public function typeTuteur()
    {
        return $this->belongsTo(TypeTuteur::class);
    }

    public function eleves()
    {
        return $this->belongsToMany(Eleve::class, 'eleve_tuteurs')
                    ->withPivot('is_principal')
                    ->withTimestamps();
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

    // Scopes
    public function scopeResponsableLegal($query)
    {
        return $query->whereHas('typeTuteur', function($q) {
            $q->where('is_responsable_legal', true);
        });
    }

    public function scopePrincipal($query)
    {
        return $query->whereHas('eleveTuteurs', function($q) {
            $q->where('is_principal', true);
        });
    }
}