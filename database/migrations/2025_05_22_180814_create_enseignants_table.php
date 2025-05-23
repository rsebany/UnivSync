<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('enseignants', function (Blueprint $table) {
            $table->id();
            $table->string('matricule', 20)->unique()->nullable();
            $table->string('prenom', 100);
            $table->string('nom', 100);
            $table->enum('genre', ['M', 'F', 'Autre']);
            $table->date('date_naissance')->nullable();
            $table->string('email', 100)->unique()->nullable();
            $table->string('telephone', 20)->nullable();
            $table->text('adresse')->nullable();
            $table->date('date_embauche')->nullable();
            $table->enum('statut', ['Actif', 'Inactif', 'Congé', 'Retraité'])->default('Actif');
            $table->decimal('salaire', 10, 2)->nullable();
            $table->foreignId('departement_id')->nullable()->constrained('departements');
            $table->timestamps();
            
            $table->index(['nom', 'prenom']);
            $table->index('email');
        });
        
        // Ajouter la contrainte de clé étrangère après création de la table enseignants
        Schema::table('departements', function (Blueprint $table) {
            $table->foreign('chef_departement_id')->references('id')->on('enseignants');
        });
    }

    public function down()
    {
        Schema::table('departements', function (Blueprint $table) {
            $table->dropForeign(['chef_departement_id']);
        });
        
        Schema::dropIfExists('enseignants');
    }
};