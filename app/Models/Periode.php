<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;

    protected $table = 'periode';
    protected $fillable = ['id_annee', 'nom', 'heure_debut', 'heure_fin', 'jour_semaine', 'is_active'];

    public function annee()
    {
        return $this->belongsTo(AnneeScolaire::class, 'id_annee');
    }

    public function classesDebut()
    {
        return $this->hasMany(Classe::class, 'id_periode_debut');
    }

    public function classesFin()
    {
        return $this->hasMany(Classe::class, 'id_periode_fin');
    }
}