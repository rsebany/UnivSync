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
        Schema::create('niveau_eleve', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_eleve');
            $table->unsignedBigInteger('id_niveau');
            $table->unsignedBigInteger('id_annee');
            $table->decimal('moyenne_generale', 4, 2)->nullable();
            $table->integer('rang_classe')->nullable();
            $table->enum('statut', ['En cours', 'Admis', 'Redouble', 'Abandonné'])->default('En cours');
            $table->timestamps();
            
            $table->unique(['id_eleve', 'id_niveau', 'id_annee']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('niveau_eleve');
    }
};