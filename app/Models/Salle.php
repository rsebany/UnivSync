<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;

    protected $table = 'salle';
    protected $fillable = [
        'type_salle_id', 'nom_salle', 'capacite', 'etage', 
        'batiment', 'equipements', 'is_active'
    ];
    
    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function typeSalle()
    {
        return $this->belongsTo(TypeSalle::class, 'type_salle_id');
    }
}