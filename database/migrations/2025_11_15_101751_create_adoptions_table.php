<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('animal_id')->constrained()->onDelete('cascade');
            $table->foreignId('demande_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->timestamps();
            
            // Chaque demande ne peut avoir qu'une adoption
            $table->unique('demande_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('adoptions');
    }
};