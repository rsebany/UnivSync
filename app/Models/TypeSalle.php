<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeSalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_type',
        'description'
    ];

    // Relations
    public function salles()
    {
        return $this->hasMany(Salle::class);
    }
}