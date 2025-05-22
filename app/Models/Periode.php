<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_periode',
        'date_debut',
        'date_fin',
        'type_periode',
        'annee_id',
        'ordre_periode',
        'is_active',
        'description'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'is_active' => 'boolean'
    ];

    // Relations
    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class, 'annee_id');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeEnCours($query)
    {
        $today = now()->toDateString();
        return $query->whereDate('date_debut', '<=', $today)
                    ->whereDate('date_fin', '>=', $today);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('ordre_periode');
    }

    // Accessors
    public function getDureeJoursAttribute()
    {
        return $this->date_debut->diffInDays($this->date_fin);
    }

    public function getEstEnCoursAttribute()
    {
        $today = now()->toDate();
        return $today >= $this->date_debut && $today <= $this->date_fin;
    }
}