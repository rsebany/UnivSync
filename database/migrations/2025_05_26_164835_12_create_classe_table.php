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
        Schema::create('classe', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_matiere');
            $table->unsignedBigInteger('id_enseignant');
            $table->unsignedBigInteger('id_trimestre');
            $table->unsignedBigInteger('id_niveau');
            $table->unsignedBigInteger('id_periode_debut');
            $table->unsignedBigInteger('id_periode_fin')->nullable();
            $table->unsignedBigInteger('id_salle')->nullable();
            $table->string('nom_classe', 100);
            $table->integer('capacite_max')->default(30);
            $table->integer('effectif_actuel')->default(0);
            $table->enum('jour_semaine', ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'])->nullable();
            $table->enum('statut', ['Programmée', 'En cours', 'Terminée', 'Annulée'])->default('Programmée');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classe');
    }
};