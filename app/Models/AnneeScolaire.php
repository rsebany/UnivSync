<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnneeScolaire extends Model
{
    use HasFactory;

    protected $table = 'annee_scolaire';
    protected $fillable = ['nom_annee', 'date_debut', 'date_fin', 'is_active'];

    public function periodes()
    {
        return $this->hasMany(Periode::class, 'id_annee');
    }

    public function trimestres()
    {
        return $this->hasMany(Trimestre::class, 'id_annee');
    }

    public function niveauxEleves()
    {
        return $this->hasMany(NiveauEleve::class, 'id_annee');
    }
}