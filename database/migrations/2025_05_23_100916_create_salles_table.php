<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('salle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_salle_id')->constrained('type_salle');
            $table->string('nom_salle', 100)->unique();
            $table->integer('capacite');
            $table->integer('etage')->nullable();
            $table->string('batiment', 50)->nullable();
            $table->text('equipements')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Ajout de la contrainte CHECK via requête SQL brute
        DB::statement('ALTER TABLE salle ADD CONSTRAINT chk_capacite_positive CHECK (capacite > 0)');
    }

    public function down()
    {
        Schema::table('salle', function (Blueprint $table) {
            $table->dropForeign(['type_salle_id']);
        });
        
        Schema::dropIfExists('salle');
    }
};