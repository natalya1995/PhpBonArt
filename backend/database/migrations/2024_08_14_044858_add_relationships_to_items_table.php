<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsToItemsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('items', function (Blueprint $table) {
      
            $table->foreignId('picture_id')->nullable()->constrained('pictures')->onDelete('set null');
            $table->foreignId('book_id')->nullable()->constrained('books')->onDelete('set null');
            $table->foreignId('jewerly_id')->nullable()->constrained('jewerlies')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            
            $table->dropForeign(['picture_id']);
            $table->dropColumn('picture_id');

            $table->dropForeign(['book_id']);
            $table->dropColumn('book_id');

            $table->dropForeign(['jewerly_id']);
            $table->dropColumn('jewerly_id');
        });
    }
}
