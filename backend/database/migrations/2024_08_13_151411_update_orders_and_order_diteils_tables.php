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
            $table->boolean('status_order')->default(false)->change();
            $table->decimal('sum', 10, 2)->default(0.00)->change();
        });

    
        Schema::table('order_diteils', function (Blueprint $table) {
            $table->boolean('Purchase_type')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('status_order')->change();
            $table->decimal('sum', 8, 2)->change();
        });

        Schema::table('order_diteils', function (Blueprint $table) {
            $table->boolean('Purchase_type')->change();
        });
    }
};
