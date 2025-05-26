<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;

    protected $table = 'salle';
    protected $fillable = ['type_salle_id', 'nom_salle', 'capacite', 'etage', 'batiment', 'equipements', 'is_active'];

    public function type()
    {
        return $this->belongsTo(TypeSalle::class, 'type_salle_id');
    }

    public function classes()
    {
        return $this->hasMany(Classe::class, 'id_salle');
    }
}