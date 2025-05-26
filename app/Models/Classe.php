<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $table = 'classe';
    protected $fillable = [
        'id_matiere', 'id_enseignant', 'id_trimestre', 'id_niveau', 
        'id_periode_debut', 'id_periode_fin', 'id_salle', 'nom_classe', 
        'capacite_max', 'effectif_actuel', 'jour_semaine', 'statut'
    ];

    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'id_matiere');
    }

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class, 'id_enseignant');
    }

    public function trimestre()
    {
        return $this->belongsTo(Trimestre::class, 'id_trimestre');
    }

    public function niveau()
    {
        return $this->belongsTo(NiveauScolaire::class, 'id_niveau');
    }

    public function periodeDebut()
    {
        return $this->belongsTo(Periode::class, 'id_periode_debut');
    }

    public function periodeFin()
    {
        return $this->belongsTo(Periode::class, 'id_periode_fin');
    }

    public function salle()
    {
        return $this->belongsTo(Salle::class, 'id_salle');
    }

    public function eleves()
    {
        return $this->belongsToMany(Eleve::class, 'eleve_classe', 'id_classe', 'id_eleve')
                    ->withPivot('statut')
                    ->withTimestamps();
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'id_classe');
    }

    public function presences()
    {
        return $this->hasMany(Presence::class, 'id_classe');
    }

    public function emploiTemps()
    {
        return $this->hasMany(EmploiTemps::class, 'id_classe');
    }
}