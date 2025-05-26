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
        Schema::create('enseignant', function (Blueprint $table) {
            $table->id();
            $table->string('matricule', 20)->unique();
            $table->string('prenom', 100);
            $table->string('nom', 100);
            $table->enum('genre', ['M', 'F', 'Autre']);
            $table->date('date_naissance')->nullable();
            $table->string('email', 100)->unique();
            $table->string('telephone', 20)->nullable();
            $table->text('adresse')->nullable();
            $table->date('date_embauche')->nullable();
            $table->enum('statut', ['Actif', 'Inactif', 'Congé', 'Retraité'])->default('Actif');
            $table->decimal('salaire', 10, 2)->nullable();
            $table->foreignId('departement_id')->nullable()->constrained('departement');
            $table->timestamps();
            
            $table->index(['nom', 'prenom']);
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enseignant');
    }
};
