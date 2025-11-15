<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('nom');

            $table->enum('espece', ['chat', 'chien', 'oiseau', 'lapin', 'tortue']);

            $table->integer('age');
            $table->enum('sexe', ['feminin', 'masculin']);
            
            $table->enum('etat_sante', ['sain', 'malade léger', 'malade grave', 'blessé']);

            $table->string('race');
            $table->string('photo')->nullable();

            $table->enum('statut', ['adopter', 'adopté', 'hébergé', 'assigner', 'à vacciner']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
