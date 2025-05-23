<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    use HasFactory;

    protected $table = 'eleve';
    protected $fillable = [
        'numero_eleve', 'prenom', 'deuxieme_prenom', 'nom',
        'date_naissance', 'lieu_naissance', 'genre', 'date_inscription',
        'adresse', 'telephone', 'email', 'photo_url', 'statut',
        'allergies', 'problemes_medicaux'
    ];
    
    protected $casts = [
        'date_naissance' => 'date',
        'date_inscription' => 'date'
    ];
}