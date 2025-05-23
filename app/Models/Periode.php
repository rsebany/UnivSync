<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;

    protected $table = 'periode';
    protected $fillable = [
        'id_annee', 'nom', 'heure_debut', 'heure_fin', 
        'jour_semaine', 'is_active'
    ];
    
    protected $casts = [
        'heure_debut' => 'datetime:H:i',
        'heure_fin' => 'datetime:H:i',
        'is_active' => 'boolean'
    ];

    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class, 'id_annee');
    }
}