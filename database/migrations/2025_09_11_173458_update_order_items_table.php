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
        Schema::table('order_items', function (Blueprint $table) {
            if (!Schema::hasColumn('order_items', 'order_id')) {
                $table->unsignedBigInteger('order_id')->after('id');
                $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            }

            if (!Schema::hasColumn('order_items', 'product_id')) {
                $table->unsignedBigInteger('product_id')->after('order_id');
                // Nếu có bảng products thì mở comment dòng dưới
                // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            }

            if (!Schema::hasColumn('order_items', 'quantity')) {
                $table->integer('quantity')->default(1)->after('product_id');
            }

            if (!Schema::hasColumn('order_items', 'price')) {
                $table->integer('price')->after('quantity');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Không xóa cột khi rollback để tránh mất dữ liệu
        });
    }
};
