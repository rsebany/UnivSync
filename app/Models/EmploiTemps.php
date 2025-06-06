<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploiTemps extends Model
{
    use HasFactory;

    protected $table = 'emploi_temps';
    protected $fillable = [
        'id_classe', 'jour_semaine', 'heure_debut', 
        'heure_fin', 'semaine_type'
    ];

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_classe');
    }
}