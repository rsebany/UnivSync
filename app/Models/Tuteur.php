<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuteur extends Model
{
    use HasFactory;

    protected $table = 'tuteur';
    protected $fillable = [
        'prenom', 'nom', 'email', 'telephone',
        'telephone_travail', 'adresse', 'profession'
    ];
}