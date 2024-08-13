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
        // Update the orders table
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('status_order')->default(false)->change();
            $table->decimal('sum', 10, 2)->default(0.00)->change();
        });

        // Update the order_diteils table
        Schema::table('order_diteils', function (Blueprint $table) {
            $table->boolean('Purchase_type')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert changes to the orders table
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('status_order')->change();
            $table->decimal('sum', 8, 2)->change();
        });

        // Revert changes to the order_diteils table
        Schema::table('order_diteils', function (Blueprint $table) {
            $table->boolean('Purchase_type')->change();
        });
    }
};
