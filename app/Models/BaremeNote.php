<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaremeNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'niveau_id',
        'note_min',
        'note_max',
        'mention',
        'appreciation',
        'couleur_affichage',
        'ordre_affichage',
        'is_admis'
    ];

    protected $casts = [
        'note_min' => 'decimal:2',
        'note_max' => 'decimal:2',
        'is_admis' => 'boolean'
    ];

    // Relations
    public function niveauScolaire()
    {
        return $this->belongsTo(NiveauScolaire::class, 'niveau_id');
    }

    // Scopes
    public function scopeAdmis($query)
    {
        return $query->where('is_admis', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('ordre_affichage')->orderBy('note_min');
    }

    // Méthodes utilitaires
    public static function getMentionPourNote($note, $niveauId)
    {
        return self::where('niveau_id', $niveauId)
                   ->where('note_min', '<=', $note)
                   ->where('note_max', '>=', $note)
                   ->first();
    }

    public function contientNote($note)
    {
        return $note >= $this->note_min && $note <= $this->note_max;
    }

    // Accessors
    public function getIntervalle()
    {
        return $this->note_min . ' - ' . $this->note_max;
    }
}