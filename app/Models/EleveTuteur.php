<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EleveTuteur extends Model
{
    use HasFactory;

    protected $fillable = [
        'eleve_id',
        'tuteur_id',
        'is_principal'
    ];

    protected $casts = [
        'is_principal' => 'boolean'
    ];

    // Relations
    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }

    public function tuteur()
    {
        return $this->belongsTo(Tuteur::class);
    }
}