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
    Schema::create('paiement', function (Blueprint $table) {
        $table->id(); // id auto-incrémenté et clé primaire
        $table->decimal('frais_jour', 10, 0);
        // $table->timestamps(); // décommente si tu veux created_at et updated_at
    });
}

public function down(): void
{
    Schema::dropIfExists('paiement');
}

};
