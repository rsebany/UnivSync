<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('trimestres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('annee_id')->constrained('annee_scolaires')->onDelete('cascade');
            $table->integer('numero_trimestre');
            $table->string('nom_trimestre', 50)->nullable();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->unique(['annee_id', 'numero_trimestre']);
            $table->index('annee_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('trimestres');
    }
};