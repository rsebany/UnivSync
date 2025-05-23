<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('classe', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_matiere')->constrained('matiere');
            $table->foreignId('id_enseignant')->constrained('enseignant');
            $table->foreignId('id_trimestre')->constrained('trimestre');
            $table->foreignId('id_niveau')->constrained('niveau_scolaire');
            $table->foreignId('id_periode_debut')->constrained('periode');
            $table->foreignId('id_periode_fin')->nullable()->constrained('periode');
            $table->foreignId('id_salle')->nullable()->constrained('salle');
            $table->string('nom_classe', 100);
            $table->integer('capacite_max')->default(30);
            $table->integer('effectif_actuel')->default(0);
            $table->enum('jour_semaine', ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'])->nullable();
            $table->enum('statut', ['Programmée', 'En cours', 'Terminée', 'Annulée'])->default('Programmée');
            $table->timestamps();
            
            //$table->check('capacite_max > 0');
            //$table->check('effectif_actuel >= 0 AND effectif_actuel <= capacite_max');
        });
    }

    public function down()
    {
        Schema::dropIfExists('classe');
    }
};