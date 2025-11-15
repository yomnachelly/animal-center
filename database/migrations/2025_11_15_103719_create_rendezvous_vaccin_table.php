<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('rendezvous_vaccin', function (Blueprint $table) {
        $table->id();
        $table->foreignId('rendezvous_id')->constrained('rendezvous')->onDelete('cascade');
        $table->foreignId('vaccin_id')->constrained()->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendezvous_vaccin');
    }
};
