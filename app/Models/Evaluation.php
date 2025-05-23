<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $table = 'evaluation';
    protected $fillable = [
        'id_eleve', 'id_classe', 'id_type_evaluation', 'note',
        'note_sur', 'date_evaluation', 'commentaire'
    ];
    
    protected $casts = [
        'note' => 'decimal:2',
        'note_sur' => 'decimal:2',
        'date_evaluation' => 'date'
    ];

    public function eleve()
    {
        return $this->belongsTo(Eleve::class, 'id_eleve');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_classe');
    }

    public function typeEvaluation()
    {
        return $this->belongsTo(TypeEvaluation::class, 'id_type_evaluation');
    }
}