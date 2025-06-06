<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTuteur extends Model
{
    use HasFactory;

    protected $table = 'type_tuteur';
    protected $fillable = ['nom', 'description'];

    public function elevesTuteurs()
    {
        return $this->hasMany(EleveTuteur::class, 'id_type_tuteur');
    }
}