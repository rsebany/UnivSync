<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_departement',
        'chef_departement_id',
        'description'
    ];

    // Relations
    public function enseignants()
    {
        return $this->hasMany(Enseignant::class);
    }

    public function matieres()
    {
        return $this->hasMany(Matiere::class);
    }

    public function chefDepartement()
    {
        return $this->belongsTo(Enseignant::class, 'chef_departement_id');
    }
}