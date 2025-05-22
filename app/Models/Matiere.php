<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;

    protected $fillable = [
        'departement_id',
        'nom_matiere',
        'code_matiere',
        'coefficient',
        'heures_par_semaine',
        'description'
    ];

    protected $casts = [
        'coefficient' => 'decimal:2'
    ];

    // Relations
    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function classes()
    {
        return $this->hasMany(Classe::class);
    }
}