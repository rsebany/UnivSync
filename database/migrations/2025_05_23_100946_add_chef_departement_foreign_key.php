<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('departement', function (Blueprint $table) {
            $table->foreign('chef_departement_id')
                  ->references('id')
                  ->on('enseignant')
                  ->nullOnDelete()
                  ->after('nom_departement');
        });
    }

    public function down()
    {
        Schema::table('departement', function (Blueprint $table) {
            $table->dropForeign(['chef_departement_id']);
        });
    }
};