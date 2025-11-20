<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('vaccins', function (Blueprint $table) {
        $table->unsignedBigInteger('vet_id')->nullable()->after('frais');
        $table->foreign('vet_id')->references('id')->on('users')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('vaccins', function (Blueprint $table) {
        $table->dropForeign(['vet_id']);
        $table->dropColumn('vet_id');
    });
}

};
