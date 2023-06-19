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
    Schema::create('artworks', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('song_id');
        // add artwork fields as required
        $table->timestamps();

        $table->foreign('song_id')->references('id')->on('songs')->onDelete('cascade');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artworks');
    }
};
