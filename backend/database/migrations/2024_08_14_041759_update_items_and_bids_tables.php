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
        Schema::table('items', function (Blueprint $table) {
          
            if (Schema::hasColumn('items', 'name')) {
                $table->renameColumn('name', 'title');
            }

          
            if (!Schema::hasColumn('items', 'description')) {
                $table->text('description')->nullable()->after('title');
            }

           
            if (!Schema::hasColumn('items', 'current_price')) {
                $table->decimal('current_price', 10, 2)->nullable()->after('starting_price');
            }

           
            if (!Schema::hasColumn('items', 'winning_bid_id')) {
                $table->foreignId('winning_bid_id')->nullable()->constrained('bids')->after('current_price');
            }
        });

        
        Schema::table('bids', function (Blueprint $table) {
           
            if (Schema::hasColumn('bids', 'bin_amount')) {
                $table->renameColumn('bin_amount', 'amount');
            }

         
            if (Schema::hasColumn('bids', 'bin_time')) {
                $table->renameColumn('bin_time', 'bid_time');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            if (Schema::hasColumn('items', 'title')) {
                $table->renameColumn('title', 'name');
            }

            if (Schema::hasColumn('items', 'description')) {
                $table->dropColumn('description');
            }

            if (Schema::hasColumn('items', 'current_price')) {
                $table->dropColumn('current_price');
            }

            if (Schema::hasColumn('items', 'winning_bid_id')) {
                $table->dropForeign(['winning_bid_id']);
                $table->dropColumn('winning_bid_id');
            }
        });

     
        Schema::table('bids', function (Blueprint $table) {
            if (Schema::hasColumn('bids', 'amount')) {
                $table->renameColumn('amount', 'bin_amount');
            }

            if (Schema::hasColumn('bids', 'bid_time')) {
                $table->renameColumn('bid_time', 'bin_time');
            }
        });
    }
};
