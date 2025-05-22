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
         Schema::create('bareme_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('niveau_id')->constrained('niveau_scolaires')->onDelete('cascade');
            $table->decimal('note_min', 4, 2);
            $table->decimal('note_max', 4, 2);
            $table->string('mention', 50);
            $table->string('appreciation', 100)->nullable();
            $table->string('couleur_affichage', 7)->nullable(); // Code couleur hex
            $table->integer('ordre_affichage')->default(1);
            $table->boolean('is_admis')->default(true);
            $table->timestamps();
            
            $table->unique(['niveau_id', 'note_min', 'note_max']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bareme_notes');
    }
};
