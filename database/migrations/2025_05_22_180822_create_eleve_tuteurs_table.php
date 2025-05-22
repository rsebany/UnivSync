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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eleve_tuteurs');
    }
};
