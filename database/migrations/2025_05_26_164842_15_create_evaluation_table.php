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
        Schema::create('evaluation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_eleve')->constrained('eleve')->onDelete('cascade');
            $table->foreignId('id_classe')->constrained('classe');
            $table->foreignId('id_type_evaluation')->constrained('type_evaluation');
            $table->decimal('note', 4, 2);
            $table->decimal('note_sur', 4, 2)->default(20.00);
            $table->date('date_evaluation');
            $table->text('commentaire')->nullable();
            $table->timestamps();
            
           // $table->check('note >= 0 AND note <= note_sur');
            $table->index(['id_eleve', 'id_classe']);
            $table->index('date_evaluation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation');
    }
};
