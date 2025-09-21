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
        Schema::table('orders', function (Blueprint $table) {
            // Nếu muốn cho phép NULL
            $table->integer('total_price')->nullable()->change();

            // Hoặc nếu muốn mặc định = 0 (bỏ comment dòng dưới và comment dòng trên)
            // $table->integer('total_price')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Nếu rollback, có thể trả về NOT NULL (tùy cấu trúc cũ)
            $table->integer('total_price')->nullable(false)->change();
        });
    }
};
