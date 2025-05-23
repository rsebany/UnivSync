<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NiveauScolaire extends Model
{
    use HasFactory;

    protected $table = 'niveau_scolaire';
    protected $fillable = ['nom_niveau', 'ordre_niveau', 'description'];
}