<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $table = 'evaluation';
    protected $fillable = [
        'id_eleve', 'id_classe', 'id_type_evaluation', 
        'note', 'note_sur', 'date_evaluation', 'commentaire'
    ];

    public function eleve()
    {
        return $this->belongsTo(Eleve::class, 'id_eleve');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_classe');
    }

    public function type()
    {
        return $this->belongsTo(TypeEvaluation::class, 'id_type_evaluation');
    }

    public function getNoteSur20Attribute()
    {
        return ($this->note / $this->note_sur) * 20;
    }
}