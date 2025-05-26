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

    public function eleves()
    {
        return $this->belongsToMany(Eleve::class, 'eleve_tuteur', 'id_tuteur', 'id_eleve')
                    ->withPivot('id_type_tuteur', 'is_contact_urgence', 'priorite_contact')
                    ->withTimestamps();
    }

    public function getFullNameAttribute()
    {
        return "{$this->prenom} {$this->nom}";
    }
}