<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'eleve_id',
        'classe_id',
        'type_evaluation_id',
        'periode_id',
        'note',
        'note_sur',
        'date_evaluation',
        'commentaire'
    ];

    protected $casts = [
        'note' => 'decimal:2',
        'note_sur' => 'decimal:2',
        'date_evaluation' => 'date'
    ];

    // Relations
    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function typeEvaluation()
    {
        return $this->belongsTo(TypeEvaluation::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    // Accessors
    public function getNoteRamenee20Attribute()
    {
        return ($this->note / $this->note_sur) * 20;
    }

    public function getPourcentageAttribute()
    {
        return ($this->note / $this->note_sur) * 100;
    }

    public function getMentionAttribute()
    {
        $noteRamenee = $this->note_ramenee_20;
        $niveauId = $this->classe->niveau_id;
        
        $bareme = BaremeNote::getMentionPourNote($noteRamenee, $niveauId);
        return $bareme ? $bareme->mention : 'Non défini';
    }

    public function getAppreciationAttribute()
    {
        $noteRamenee = $this->note_ramenee_20;
        $niveauId = $this->classe->niveau_id;
        
        $bareme = BaremeNote::getMentionPourNote($noteRamenee, $niveauId);
        return $bareme ? $bareme->appreciation : '';
    }

    // Scopes
    public function scopeParPeriode($query, $dateDebut, $dateFin)
    {
        return $query->whereBetween('date_evaluation', [$dateDebut, $dateFin]);
    }

    public function scopeParMatiere($query, $matiereId)
    {
        return $query->whereHas('classe', function($q) use ($matiereId) {
            $q->where('matiere_id', $matiereId);
        });
    }

    public function scopeParNiveau($query, $niveauId)
    {
        return $query->whereHas('classe', function($q) use ($niveauId) {
            $q->where('niveau_id', $niveauId);
        });
    }

    // Méthodes utilitaires
    public function estReussie($seuilReussite = 10)
    {
        return $this->note_ramenee_20 >= $seuilReussite;
    }

    public static function getMoyenneClasse($classeId, $periodeId = null)
    {
        $query = self::where('classe_id', $classeId);
        
        if ($periodeId) {
            $query->where('periode_id', $periodeId);
        }
        
        return $query->avg('note_ramenee_20');
    }
}