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
        Schema::table('classe', function (Blueprint $table) {
            $table->foreign('id_matiere')->references('id')->on('matiere');
            $table->foreign('id_enseignant')->references('id')->on('enseignant');
            $table->foreign('id_trimestre')->references('id')->on('trimestre');
            $table->foreign('id_niveau')->references('id')->on('niveau_scolaire');
            $table->foreign('id_periode_debut')->references('id')->on('periode');
            $table->foreign('id_periode_fin')->references('id')->on('periode');
            $table->foreign('id_salle')->references('id')->on('salle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classe', function (Blueprint $table) {
            $table->dropForeign(['id_matiere']);
            $table->dropForeign(['id_enseignant']);
            $table->dropForeign(['id_trimestre']);
            $table->dropForeign(['id_niveau']);
            $table->dropForeign(['id_periode_debut']);
            $table->dropForeign(['id_periode_fin']);
            $table->dropForeign(['id_salle']);
        });
    }
};