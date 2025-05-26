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
            
            //$table->check('capacite > 0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salle');
    }
};
