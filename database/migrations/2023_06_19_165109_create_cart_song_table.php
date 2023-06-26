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
    Schema::create('cart_song', function (Blueprint $table) {
        $table->unsignedBigInteger('cart_id');
        $table->unsignedBigInteger('song_id');
        // Add any additional columns if needed

        // Define foreign key constraints
        $table->foreign('cart_id')->references('id')->on('carts');
        $table->foreign('song_id')->references('id')->on('songs')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_song');
    }
};
