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
        Schema::create('eleves', function (Blueprint $table) {
            $table->id();
            $table->string('numero_eleve', 20)->unique()->nullable();
            $table->string('prenom', 100);
            $table->string('deuxieme_prenom', 100)->nullable();
            $table->string('nom', 100);
            $table->date('date_naissance');
            $table->string('lieu_naissance', 100)->nullable();
            $table->enum('genre', ['M', 'F']);
            $table->date('date_inscription');
            $table->text('adresse')->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('photo_url', 255)->nullable();
            $table->enum('statut', ['Actif', 'Inactif', 'Transféré', 'Diplômé'])->default('Actif');
            $table->text('allergies')->nullable();
            $table->text('problemes_medicaux')->nullable();
            $table->timestamps();
            
            $table->index(['nom', 'prenom']);
            $table->index('numero_eleve');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eleves');
    }
};
