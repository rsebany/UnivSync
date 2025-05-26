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
            $table->decimal('note_min', 4, 2);
            $table->decimal('note_max', 4, 2);
            $table->string('mention', 20);
            $table->string('couleur_code', 7)->nullable(); // Hex color code
            $table->text('description')->nullable();
            $table->timestamps();
            
            //$table->check('note_max > note_min');
           // $table->check('note_min >= 0');
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
