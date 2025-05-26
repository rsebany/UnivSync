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
        Schema::create('periode', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_annee')->constrained('annee_scolaire')->onDelete('cascade');
            $table->string('nom', 100);
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->enum('jour_semaine', ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche']);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->unique(['id_annee', 'nom', 'jour_semaine']);
            //$table->check('heure_fin > heure_debut');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periode');
    }
};
