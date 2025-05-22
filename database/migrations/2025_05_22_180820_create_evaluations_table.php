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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
