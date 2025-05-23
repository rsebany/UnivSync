<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $table = 'departement';
    protected $fillable = [
        'nom_departement', 'chef_departement_id', 'description'
    ];

    public function chefDepartement()
    {
        return $this->belongsTo(Enseignant::class, 'chef_departement_id');
    }

    public function enseignants()
    {
        return $this->hasMany(Enseignant::class, 'departement_id');
    }
}