<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('eleve_classe', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_eleve')->constrained('eleve')->onDelete('cascade');
            $table->foreignId('id_classe')->constrained('classe')->onDelete('cascade');
            $table->timestamp('date_inscription')->useCurrent();
            $table->enum('statut', ['Inscrit', 'Présent', 'Absent', 'Excusé', 'Abandonné'])->default('Inscrit');
            $table->timestamps();
            
            $table->unique(['id_eleve', 'id_classe']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('eleve_classe');
    }
};