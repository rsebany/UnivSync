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
        Schema::create('type_tuteurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom_type', 100)->unique();
            $table->text('description')->nullable();
            $table->boolean('is_responsable_legal')->default(false);
            $table->integer('priorite_contact')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_tuteurs');
    }
};
