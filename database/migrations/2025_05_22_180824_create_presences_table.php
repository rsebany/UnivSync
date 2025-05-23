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
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eleve_id')->constrained('eleves')->onDelete('cascade');
            $table->foreignId('classe_id')->constrained('classes');
            $table->date('date_cours');
            $table->enum('statut', ['Présent', 'Absent', 'Retard', 'Excusé']);
            $table->time('heure_arrivee')->nullable();
            $table->text('commentaire')->nullable();
            $table->timestamps();
            
            $table->unique(['eleve_id', 'classe_id', 'date_cours']);
            $table->index('date_cours');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presences');
    }
};
