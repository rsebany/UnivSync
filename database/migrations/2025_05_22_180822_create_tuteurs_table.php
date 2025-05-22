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
        Schema::create('tuteurs', function (Blueprint $table) {
            $table->id();
            $table->string('prenom', 100);
            $table->string('nom', 100);
            $table->string('email', 100)->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('telephone_travail', 20)->nullable();
            $table->text('adresse')->nullable();
            $table->string('profession', 100)->nullable();
            $table->timestamps();
            
            $table->index(['nom', 'prenom']);
            $table->index('telephone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tuteurs');
    }
};
