<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    use HasFactory;

    protected $table = 'enseignant';
    protected $fillable = [
        'matricule', 'prenom', 'nom', 'genre', 'date_naissance',
        'email', 'telephone', 'adresse', 'date_embauche', 'statut',
        'salaire', 'departement_id'
    ];
    
    protected $casts = [
        'date_naissance' => 'date',
        'date_embauche' => 'date',
        'salaire' => 'decimal:2'
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }
}