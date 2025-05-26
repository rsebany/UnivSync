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
        Schema::create('trimestre', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_annee')->constrained('annee_scolaire')->onDelete('cascade');
            $table->integer('numero_trimestre');
            $table->string('nom_trimestre', 50)->nullable();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->unique(['id_annee', 'numero_trimestre']);
            //$table->check('date_fin > date_debut');
            //$table->check('numero_trimestre BETWEEN 1 AND 4');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trimestre');
    }
};
