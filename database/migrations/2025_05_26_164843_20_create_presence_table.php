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
        Schema::create('presence', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_eleve')->constrained('eleve')->onDelete('cascade');
            $table->foreignId('id_classe')->constrained('classe');
            $table->date('date_cours');
            $table->enum('statut', ['Présent', 'Absent', 'Retard', 'Excusé']);
            $table->time('heure_arrivee')->nullable();
            $table->text('commentaire')->nullable();
            $table->timestamps();
            
            $table->unique(['id_eleve', 'id_classe', 'date_cours']);
            $table->index('date_cours');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presence');
    }
};
