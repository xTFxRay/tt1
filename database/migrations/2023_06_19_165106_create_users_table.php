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
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->binary('image')->nullable();
        $table->string('password');
        $table->enum('role', ['guest', 'gmail', 'registered', 'admin'])->default('registered');
        $table->string('google_token')->nullable();
        $table->timestamps();
        $table->string('profile_picture')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
