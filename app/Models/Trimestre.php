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

    public function annee()
    {
        return $this->belongsTo(AnneeScolaire::class, 'id_annee');
    }

    public function classes()
    {
        return $this->hasMany(Classe::class, 'id_trimestre');
    }
}