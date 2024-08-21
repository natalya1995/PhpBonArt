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
            $table->text('description')->nullable()->after('name');
            $table->decimal('current_price', 10, 2)->nullable()->after('starting_price');
            $table->foreignId('winning_bid_id')->nullable()->constrained('bids')->onDelete('set null')->after('current_price');
            $table->foreignId('picture_id')->nullable()->constrained('pictures')->onDelete('set null')->after('winning_bid_id');
            $table->foreignId('book_id')->nullable()->constrained('books')->onDelete('set null')->after('picture_id');
            $table->foreignId('jewerly_id')->nullable()->constrained('jewerlies')->onDelete('set null')->after('book_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('current_price');
            $table->dropForeign(['winning_bid_id']);
            $table->dropColumn('winning_bid_id');
            $table->dropForeign(['picture_id']);
            $table->dropColumn('picture_id');
            $table->dropForeign(['book_id']);
            $table->dropColumn('book_id');
            $table->dropForeign(['jewerly_id']);
            $table->dropColumn('jewerly_id');
        });
    }
};
