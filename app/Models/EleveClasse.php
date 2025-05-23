<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EleveClasse extends Model
{
    use HasFactory;

    protected $table = 'eleve_classe';
    protected $fillable = ['id_eleve', 'id_classe', 'statut'];

    public function eleve()
    {
        return $this->belongsTo(Eleve::class, 'id_eleve');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_classe');
    }
}