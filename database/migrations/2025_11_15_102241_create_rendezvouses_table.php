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
        Schema::create('rendezvous', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade'); // supprime les rendez-vous si l'utilisateur est supprimé
            $table->foreignId('animal_id')
                  ->constrained()
                  ->onDelete('cascade'); // supprime les rendez-vous si l'animal est supprimé
            $table->dateTime('date');
            $table->enum('etat', ['en attente', 'accepté', 'rejeté'])->default('en attente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendezvous');
    }
};
