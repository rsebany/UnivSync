<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;

    protected $table = 'matiere';
    protected $fillable = [
        'id_departement', 'nom_matiere', 'code_matiere', 
        'coefficient', 'heures_par_semaine', 'description', 'is_active'
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement');
    }

    public function classes()
    {
        return $this->hasMany(Classe::class, 'id_matiere');
    }
}