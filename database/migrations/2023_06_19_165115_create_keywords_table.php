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
    Schema::create('keywords', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('song_id');
        $table->string('title');
        $table->string('keyword');
        $table->timestamps();

        $table->foreign('song_id')->references('id')->on('songs')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keywords');
    }
};
