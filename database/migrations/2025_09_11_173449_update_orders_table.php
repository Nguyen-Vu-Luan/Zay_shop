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
        Schema::table('orders', function (Blueprint $table) {
            // Nếu chưa có order_code thì thêm
            if (!Schema::hasColumn('orders', 'order_code')) {
                $table->string('order_code', 50)->unique()->after('id');
            }

            // Nếu chưa có user_id thì thêm
            if (!Schema::hasColumn('orders', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('order_code');
                // Nếu có bảng users thì mở comment dòng dưới
                // $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            }

            // Nếu chưa có total_amount thì thêm
            if (!Schema::hasColumn('orders', 'total_amount')) {
                $table->integer('total_amount')->after('user_id');
            }

            // Nếu chưa có status thì thêm
            if (!Schema::hasColumn('orders', 'status')) {
                $table->enum('status', ['pending', 'paid', 'failed'])->default('pending')->after('total_amount');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
        });
    }
};
