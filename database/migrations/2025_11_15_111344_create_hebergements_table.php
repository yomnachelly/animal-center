<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hebergements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demande_id')->constrained()->onDelete('cascade'); // FK vers demandes
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // FK vers users
            $table->foreignId('animal_id')->constrained()->onDelete('cascade'); // FK vers animals
            $table->date('date_debut');
            $table->date('date_fin');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hebergements');
    }
};
