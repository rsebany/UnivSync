<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeSalle extends Model
{
    use HasFactory;

    protected $table = 'type_salle';
    protected $fillable = ['nom', 'description'];

    public function salles()
    {
        return $this->hasMany(Salle::class, 'type_salle_id');
    }
}