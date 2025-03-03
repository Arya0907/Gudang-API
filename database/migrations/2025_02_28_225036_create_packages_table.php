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
        Schema::create('packages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('tracking_number')->unique();

            // Relasi ke tabel users (pengirim)
            $table->uuid('sender_id');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');

            // Jika penerima juga adalah user terdaftar, bisa ditambahkan
            $table->uuid('receiver_id')->nullable();
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('set null');

            $table->text('receiver_address');
            $table->string('receiver_phone');
            $table->decimal('weight', 8, 2);
            $table->enum('status', ['pending', 'on delivery', 'delivered'])->default('pending');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
