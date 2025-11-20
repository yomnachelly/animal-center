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

            // 🔗 Foreign keys
            $table->unsignedBigInteger('espece_id');
            $table->unsignedBigInteger('race_id')->nullable(); // parfois optionnel

            $table->integer('age');
            $table->enum('sexe', ['feminin', 'masculin']);

            $table->enum('etat_sante', ['sain', 'malade léger', 'malade grave', 'blessé']);

            $table->longBlob('photo')->nullable();

            $table->enum('statut', ['adopter', 'adopté', 'hébergé', 'assigner', 'à vacciner']);

            $table->timestamps();

            // relations
            $table->foreign('espece_id')->references('id')->on('especes')->onDelete('cascade');
            $table->foreign('race_id')->references('id')->on('races')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
