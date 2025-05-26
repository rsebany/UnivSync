<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NiveauScolaire extends Model
{
    use HasFactory;

    protected $table = 'niveau_scolaire';
    protected $fillable = ['nom_niveau', 'ordre_niveau', 'description'];

    public function classes()
    {
        return $this->hasMany(Classe::class, 'id_niveau');
    }

    public function eleves()
    {
        return $this->belongsToMany(Eleve::class, 'niveau_eleve', 'id_niveau', 'id_eleve')
                    ->withPivot('id_annee', 'moyenne_generale', 'rang_classe', 'statut')
                    ->withTimestamps();
    }
}