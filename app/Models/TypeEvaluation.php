<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeEvaluation extends Model
{
    use HasFactory;

    protected $table = 'type_evaluation';
    protected $fillable = ['nom', 'coefficient', 'description'];

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'id_type_evaluation');
    }
}