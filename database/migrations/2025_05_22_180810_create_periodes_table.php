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
            $table->string('nom_periode', 100);
            $table->date('date_debut');
            $table->date('date_fin');
            $table->enum('type_periode', ['trimestre', 'semestre', 'annuel'])->default('trimestre');
            $table->foreignId('annee_id')->constrained('annee_scolaires')->onDelete('cascade');
            $table->integer('ordre_periode');
            $table->boolean('is_active')->default(false);
            $table->text('description')->nullable();
            $table->timestamps();
            
            $table->unique(['annee_id', 'ordre_periode']);
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
