<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTuteur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_type',
        'description',
        'is_responsable_legal',
        'priorite_contact'
    ];

    protected $casts = [
        'is_responsable_legal' => 'boolean'
    ];

    // Relations
    public function tuteurs()
    {
        return $this->hasMany(Tuteur::class);
    }

    // Scopes
    public function scopeResponsableLegal($query)
    {
        return $query->where('is_responsable_legal', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('priorite_contact');
    }
}