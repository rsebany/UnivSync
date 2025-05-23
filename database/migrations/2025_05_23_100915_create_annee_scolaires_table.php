<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('annee_scolaire', function (Blueprint $table) {
            $table->id();
            $table->string('nom_annee', 100)->unique();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        // Ajout de la contrainte CHECK via une requête SQL brute
        //DB::statement('ALTER TABLE annee_scolaire ADD CONSTRAINT chk_dates_annee CHECK (date_fin > date_debut)');
    }

    public function down()
    {
        Schema::dropIfExists('annee_scolaire');
    }
};