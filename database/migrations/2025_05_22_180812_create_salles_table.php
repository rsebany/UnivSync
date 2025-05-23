<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('type_salles', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });
        
        Schema::create('salles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_salle_id')->constrained()->onDelete('restrict');
            $table->string('nom_salle', 100)->unique();
            $table->integer('capacite');
            $table->integer('etage')->nullable();
            $table->string('batiment', 50)->nullable();
            $table->text('equipements')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['type_salle_id', 'is_active']); // Composite index might be more useful
        });
    }

    public function down()
    {
        // Drop in reverse order to respect foreign key constraints
        Schema::dropIfExists('salles');
        Schema::dropIfExists('type_salles');
    }
};