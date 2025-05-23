<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trimestre extends Model
{
    use HasFactory;

    protected $table = 'trimestre';
    protected $fillable = [
        'id_annee', 'numero_trimestre', 'nom_trimestre',
        'date_debut', 'date_fin', 'is_active'
    ];
    
    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'is_active' => 'boolean'
    ];

    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class, 'id_annee');
    }
}