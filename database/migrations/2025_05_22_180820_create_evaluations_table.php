<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
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
        
        Schema::create('eleve_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eleve_id')->constrained('eleves')->onDelete('cascade');
            $table->foreignId('classe_id')->constrained('classes')->onDelete('cascade');
            $table->timestamp('date_inscription')->useCurrent();
            $table->enum('statut', ['Inscrit', 'Présent', 'Absent', 'Excusé', 'Abandonné'])->default('Inscrit');
            $table->timestamps();
            
            $table->unique(['eleve_id', 'classe_id']);
        });
        
        Schema::create('type_evaluations', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 50)->unique();
            $table->decimal('coefficient', 3, 2)->default(1.00);
            $table->text('description')->nullable();
            $table->timestamps();
        });
        
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eleve_id')->constrained('eleves')->onDelete('cascade');
            $table->foreignId('classe_id')->constrained('classes');
            $table->foreignId('type_evaluation_id')->constrained('type_evaluations');
            $table->decimal('note', 4, 2);
            $table->decimal('note_sur', 4, 2)->default(20.00);
            $table->date('date_evaluation');
            $table->text('commentaire')->nullable();
            $table->timestamps();
            
            $table->index(['eleve_id', 'classe_id']);
            $table->index('date_evaluation');
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluations');
        Schema::dropIfExists('type_evaluations'); 
        Schema::dropIfExists('eleve_classes');
        Schema::dropIfExists('niveau_eleves');
    }
};