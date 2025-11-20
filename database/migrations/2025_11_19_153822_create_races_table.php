<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('espece_id'); // race dépend de l’espèce
            
            $table->string('nom'); // ex: Berger allemand, Siamois...
            
            $table->timestamps();

            // relation
            $table->foreign('espece_id')
                  ->references('id')
                  ->on('especes')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('races');
    }
};
