<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('niveau_eleve', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_eleve')->constrained('eleve')->onDelete('cascade');
            $table->foreignId('id_niveau')->constrained('niveau_scolaire');
            $table->foreignId('id_annee')->constrained('annee_scolaire');
            $table->decimal('moyenne_generale', 4, 2)->nullable();
            $table->integer('rang_classe')->nullable();
            $table->enum('statut', ['En cours', 'Admis', 'Redouble', 'Abandonné'])->default('En cours');
            $table->timestamps();
            
            $table->unique(['id_eleve', 'id_niveau', 'id_annee']);
            //$table->check('moyenne_generale >= 0 AND moyenne_generale <= 20');
        });
    }

    public function down()
    {
        Schema::dropIfExists('niveau_eleve');
    }
};