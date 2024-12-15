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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Kolom UUID
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['warga', 'pengelola', 'admin'])->default('warga');
            $table->string('phone_number', 15)->nullable();
            $table->string('profile_picture', 255)->nullable();
            $table->uuid('region_id')->nullable(); // Kolom foreign key dengan tipe UUID
            $table->foreign('region_id')->references('id')->on('regions')->nullOnDelete(); // Definisi foreign key
            $table->timestamps();
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
