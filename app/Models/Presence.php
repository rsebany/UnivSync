<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    protected $table = 'presence';
    protected $fillable = [
        'id_eleve', 'id_classe', 'date_cours', 'statut',
        'heure_arrivee', 'commentaire'
    ];
    
    protected $casts = [
        'date_cours' => 'date',
        'heure_arrivee' => 'datetime:H:i'
    ];

    public function eleve()
    {
        return $this->belongsTo(Eleve::class, 'id_eleve');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_classe');
    }
}