<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('emploi_temps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_classe')->constrained('classe')->onDelete('cascade');
            $table->enum('jour_semaine', ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche']);
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->integer('semaine_type')->default(1); // For A/B weeks
            $table->timestamps();
            
            //$table->check('heure_fin > heure_debut');
        });
    }

    public function down()
    {
        Schema::dropIfExists('emploi_temps');
    }
};