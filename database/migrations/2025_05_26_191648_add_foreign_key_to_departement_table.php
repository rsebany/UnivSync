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
        Schema::table('departement', function (Blueprint $table) {
            $table->foreign('chef_departement_id')
                  ->references('id')
                  ->on('enseignant')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departement', function (Blueprint $table) {
            $table->dropForeign(['chef_departement_id']);
        });
    }
};