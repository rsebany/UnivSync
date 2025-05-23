<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('type_tuteurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 50)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });
        
        Schema::create('tuteurs', function (Blueprint $table) {
            $table->id();
            $table->string('prenom', 100);
            $table->string('nom', 100);
            $table->string('email', 100)->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('telephone_travail', 20)->nullable();
            $table->text('adresse')->nullable();
            $table->string('profession', 100)->nullable();
            $table->timestamps();
            
            $table->index(['nom', 'prenom']);
            $table->index('telephone');
        });
        
        Schema::create('eleve_tuteurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eleve_id')->constrained('eleves')->onDelete('cascade');
            $table->foreignId('type_tuteur_id')->constrained('type_tuteurs');
            $table->foreignId('tuteur_id')->constrained('tuteurs');
            $table->boolean('is_contact_urgence')->default(false);
            $table->integer('priorite_contact')->default(1);
            $table->timestamps();
            
            $table->unique(['eleve_id', 'type_tuteur_id', 'tuteur_id']);
        });
        
        Schema::create('bareme_notes', function (Blueprint $table) {
            $table->id();
            $table->decimal('note_min', 4, 2);
            $table->decimal('note_max', 4, 2);
            $table->string('mention', 20);
            $table->string('couleur_code', 7)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
        
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
        
        Schema::create('emploi_temps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classe_id')->constrained('classes')->onDelete('cascade');
            $table->enum('jour_semaine', ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche']);
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->integer('semaine_type')->default(1);
            $table->timestamps();
            
            $table->index(['classe_id', 'jour_semaine']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('emploi_temps');
        Schema::dropIfExists('presences');
        Schema::dropIfExists('bareme_notes');
        Schema::dropIfExists('eleve_tuteurs');
        Schema::dropIfExists('tuteurs');
        Schema::dropIfExists('type_tuteurs');
    }
};