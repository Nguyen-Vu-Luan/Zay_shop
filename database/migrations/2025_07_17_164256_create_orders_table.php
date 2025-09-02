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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('total_price', 10, 2);
            $table->string('status')->default('pending'); // pending, confirmed, shipped, cancelled
            $table->string('payment_status')->default('pending'); // pending, success, failed
            $table->string('payment_method')->nullable(); // cod, momo, etc
            $table->enum('status', ['pending', 'confirmed', 'shipped', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
