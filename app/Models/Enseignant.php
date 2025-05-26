<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    use HasFactory;

    protected $table = 'enseignant';
    protected $fillable = [
        'matricule', 'prenom', 'nom', 'genre', 'date_naissance', 'email', 
        'telephone', 'adresse', 'date_embauche', 'statut', 'salaire', 'departement_id'
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

    public function classes()
    {
        return $this->hasMany(Classe::class, 'id_enseignant');
    }

    public function managedDepartement()
    {
        return $this->hasOne(Departement::class, 'chef_departement_id');
    }

    public function getFullNameAttribute()
    {
        return "{$this->prenom} {$this->nom}";
    }
}