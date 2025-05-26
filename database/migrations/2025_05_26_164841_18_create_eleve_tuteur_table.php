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
        Schema::create('eleve_tuteur', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_eleve')->constrained('eleve')->onDelete('cascade');
            $table->foreignId('id_type_tuteur')->constrained('type_tuteur');
            $table->foreignId('id_tuteur')->constrained('tuteur');
            $table->boolean('is_contact_urgence')->default(false);
            $table->integer('priorite_contact')->default(1);
            $table->timestamps();
            
            $table->unique(['id_eleve', 'id_type_tuteur', 'id_tuteur']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eleve_tuteur');
    }
};
