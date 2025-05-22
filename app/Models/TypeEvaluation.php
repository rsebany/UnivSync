<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeEvaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_type',
        'coefficient',
        'description'
    ];

    protected $casts = [
        'coefficient' => 'decimal:2'
    ];

    // Relations
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}