<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_salle_id',
        'nom_salle',
        'capacite',
        'etage',
        'batiment'
    ];

    // Relations
    public function typeSalle()
    {
        return $this->belongsTo(TypeSalle::class);
    }

    public function classes()
    {
        return $this->hasMany(Classe::class);
    }
}