<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
