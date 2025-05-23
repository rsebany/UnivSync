<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EleveTuteur extends Model
{
    use HasFactory;

    protected $table = 'eleve_tuteur';
    protected $fillable = [
        'id_eleve', 'id_type_tuteur', 'id_tuteur',
        'is_contact_urgence', 'priorite_contact'
    ];
    
    protected $casts = [
        'is_contact_urgence' => 'boolean'
    ];

    public function eleve()
    {
        return $this->belongsTo(Eleve::class, 'id_eleve');
    }

    public function typeTuteur()
    {
        return $this->belongsTo(TypeTuteur::class, 'id_type_tuteur');
    }

    public function tuteur()
    {
        return $this->belongsTo(Tuteur::class, 'id_tuteur');
    }
}