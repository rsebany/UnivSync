<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bareme_notes', function (Blueprint $table) {
            $table->id();
            $table->decimal('note_min', 4, 2);
            $table->decimal('note_max', 4, 2);
            $table->string('mention', 20);
            $table->string('couleur_code', 7)->nullable(); // Code couleur hexadécimal
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Ajout des contraintes CHECK via des requêtes SQL brutes
        //DB::statement('ALTER TABLE bareme_notes ADD CONSTRAINT chk_bareme_valide CHECK (note_max > note_min)');
        //DB::statement('ALTER TABLE bareme_notes ADD CONSTRAINT chk_notes_positives CHECK (note_min >= 0)');
    }

    public function down()
    {
        Schema::dropIfExists('bareme_notes');
    }
};