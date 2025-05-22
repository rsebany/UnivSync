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
        Schema::create('niveau_eleves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eleve_id')->constrained('eleves')->onDelete('cascade');
            $table->foreignId('niveau_id')->constrained('niveau_scolaires');
            $table->foreignId('annee_id')->constrained('annee_scolaires');
            $table->decimal('moyenne_generale', 4, 2)->nullable();
            $table->integer('rang_classe')->nullable();
            $table->enum('statut', ['En cours', 'Admis', 'Redouble', 'Abandonné'])->default('En cours');
            $table->timestamps();
            
            $table->unique(['eleve_id', 'niveau_id', 'annee_id']);
            $table->index('annee_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('niveau_eleves');
    }
};
