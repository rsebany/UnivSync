<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('periodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('annee_id')->constrained('annee_scolaires')->onDelete('cascade');
            $table->string('nom', 100);
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->enum('jour_semaine', ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'])->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->unique(['annee_id', 'nom', 'jour_semaine']);
        });
        
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matiere_id')->constrained('matieres');
            $table->foreignId('enseignant_id')->constrained('enseignants');
            $table->foreignId('trimestre_id')->constrained('trimestres');
            $table->foreignId('niveau_id')->constrained('niveau_scolaires');
            $table->foreignId('periode_debut_id')->constrained('periodes');
            $table->foreignId('periode_fin_id')->nullable()->constrained('periodes');
            $table->foreignId('salle_id')->nullable()->constrained('salles');
            $table->string('nom_classe', 100);
            $table->integer('capacite_max')->default(30);
            $table->integer('effectif_actuel')->default(0);
            $table->enum('jour_semaine', ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'])->nullable();
            $table->enum('statut', ['Programmée', 'En cours', 'Terminée', 'Annulée'])->default('Programmée');
            $table->timestamps();
            
            $table->index(['trimestre_id', 'niveau_id']);
            $table->index(['enseignant_id', 'matiere_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('classes');
        Schema::dropIfExists('periodes');
    }
};