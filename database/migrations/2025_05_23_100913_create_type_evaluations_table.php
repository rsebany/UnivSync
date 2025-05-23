<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('type_evaluation', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 50)->unique();
            $table->decimal('coefficient', 3, 2)->default(1.00);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('type_evaluation');
    }
};