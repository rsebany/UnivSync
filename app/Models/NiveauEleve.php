<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NiveauEleve extends Model
{
    use HasFactory;

    protected $table = 'niveau_eleve';
    protected $fillable = [
        'id_eleve', 'id_niveau', 'id_annee', 'moyenne_generale',
        'rang_classe', 'statut'
    ];
    
    protected $casts = [
        'moyenne_generale' => 'decimal:2'
    ];

    public function eleve()
    {
        return $this->belongsTo(Eleve::class, 'id_eleve');
    }

    public function niveau()
    {
        return $this->belongsTo(NiveauScolaire::class, 'id_niveau');
    }

    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class, 'id_annee');
    }
}