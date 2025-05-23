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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodes');
    }
};
