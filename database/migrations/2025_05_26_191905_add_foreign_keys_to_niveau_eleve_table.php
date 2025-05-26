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
        Schema::table('niveau_eleve', function (Blueprint $table) {
            $table->foreign('id_eleve')
                  ->references('id')
                  ->on('eleve')
                  ->onDelete('cascade');
                  
            $table->foreign('id_niveau')
                  ->references('id')
                  ->on('niveau_scolaire');
                  
            $table->foreign('id_annee')
                  ->references('id')
                  ->on('annee_scolaire');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('niveau_eleve', function (Blueprint $table) {
            $table->dropForeign(['id_eleve']);
            $table->dropForeign(['id_niveau']);
            $table->dropForeign(['id_annee']);
        });
    }
};