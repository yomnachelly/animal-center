<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paiements_hebergements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hebergement_id')->constrained()->onDelete('cascade'); // FK vers hébergements
            $table->decimal('frais_par_jour', 10, 2)->default(0);
            $table->date('date_paiement')->nullable();
            $table->enum('status_paiement', ['en_attente', 'payé', 'annulé'])->default('en_attente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paiements_hebergements');
    }
};
