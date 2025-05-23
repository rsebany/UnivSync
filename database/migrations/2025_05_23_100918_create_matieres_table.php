<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('matiere', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_departement')->constrained('departement');
            $table->string('nom_matiere', 100);
            $table->string('code_matiere', 20)->unique();
            $table->decimal('coefficient', 3, 2)->default(1.00);
            $table->integer('heures_par_semaine')->default(1);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            //$table->check('coefficient > 0');
            //$table->check('heures_par_semaine > 0');
        });
    }

    public function down()
    {
        Schema::dropIfExists('matiere');
    }
};