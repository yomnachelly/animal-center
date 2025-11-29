<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stripe', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hebergement_id')->constrained()->onDelete('cascade');
            $table->string('stripe_session_id')->unique();
            $table->string('stripe_payment_intent_id')->nullable();
            $table->string('stripe_customer_id')->nullable();
            $table->string('customer_email')->nullable();
            $table->decimal('montant_dt', 10, 2);
            $table->decimal('montant_usd', 10, 2);
            $table->decimal('taux_change', 8, 4);
            $table->integer('nombre_jours');
            $table->decimal('frais_jour', 8, 2);
            $table->string('statut');
            $table->text('metadata')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stripe');
    }
};