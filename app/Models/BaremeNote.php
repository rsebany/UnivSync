<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaremeNote extends Model
{
    use HasFactory;

    protected $table = 'bareme_notes';
    protected $fillable = [
        'note_min', 'note_max', 'mention', 'couleur_code', 'description'
    ];
    
    protected $casts = [
        'note_min' => 'decimal:2',
        'note_max' => 'decimal:2'
    ];
}