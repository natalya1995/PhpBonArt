<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Pictures table
        Schema::table('pictures', function (Blueprint $table) {
            $table->foreign('creator_id')->references('id')->on('creators')->onDelete('set null');
            $table->foreign('janre_id')->references('id')->on('janres')->onDelete('set null');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');
            $table->foreign('sector_id')->references('id')->on('sector')->onDelete('set null');
            $table->foreign('committent_id')->references('id')->on('committents')->onDelete('set null');
        });

        // Orders table 
        Schema::table('order', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order_detl_id')->references('id')->on('order_diteil')->onDelete('cascade');
        });

        // Order Details table
        Schema::table('order_diteil', function (Blueprint $table) {
            $table->foreign('picture_id')->references('id')->on('pictures')->onDelete('set null');
            $table->foreign('bids_id')->references('id')->on('bids')->onDelete('set null');
        });

        // Bids table
        Schema::table('bids', function (Blueprint $table) {
            $table->foreign('auction_id')->references('id')->on('auctions')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });

        // Books table
        Schema::table('books', function (Blueprint $table) {
            $table->foreign('creator_id')->references('id')->on('creators')->onDelete('set null');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');
        });

        // Jewerly table
        Schema::table('jewerly', function (Blueprint $table) {
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');
        });

        // Locations table
        Schema::table('locations', function (Blueprint $table) {
            $table->foreign('picture_id')->references('id')->on('pictures')->onDelete('set null');
        });

        // Sectors table
        Schema::table('sector', function (Blueprint $table) {
            $table->foreign('picture_id')->references('id')->on('pictures')->onDelete('set null');
        });

        // Janres table
        Schema::table('janres', function (Blueprint $table) {
            $table->foreign('picture_id')->references('id')->on('pictures')->onDelete('set null');
        });

        // Committents table
        Schema::table('committents', function (Blueprint $table) {
            $table->foreign('picture_id')->references('id')->on('pictures')->onDelete('set null');
        });

        // Creators table
        Schema::table('creators', function (Blueprint $table) {
            $table->foreign('picture_id')->references('id')->on('pictures')->onDelete('set null');
        });

        // Picture Janre table
        Schema::table('picture_janre', function (Blueprint $table) {
            $table->foreign('picture_id')->references('id')->on('pictures')->onDelete('set null');
            $table->foreign('janre_id')->references('id')->on('janres')->onDelete('set null');
        });

        // Creators Pictures table
        Schema::table('_creators_pictures', function (Blueprint $table) {
            $table->foreign('picture_id')->references('id')->on('pictures')->onDelete('set null');
            $table->foreign('creator_id')->references('id')->on('creators')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Pictures table
        Schema::table('pictures', function (Blueprint $table) {
            $table->dropForeign(['creator_id']);
            $table->dropForeign(['janre_id']);
            $table->dropForeign(['location_id']);
            $table->dropForeign(['sector_id']);
            $table->dropForeign(['committent_id']);
        });

        // Orders table
        Schema::table('order', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['order_detl_id']);
        });

        // Order Details table
        Schema::table('order_diteil', function (Blueprint $table) {
            $table->dropForeign(['picture_id']);
            $table->dropForeign(['bids_id']);
        });

        // Bids table
        Schema::table('bids', function (Blueprint $table) {
            $table->dropForeign(['auction_id']);
            $table->dropForeign(['user_id']);
        });

        // Books table
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['creator_id']);
            $table->dropForeign(['location_id']);
        });

        // Jewerly table
        Schema::table('jewerly', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
        });

        // Locations table
        Schema::table('locations', function (Blueprint $table) {
            $table->dropForeign(['picture_id']);
        });

        // Sectors table
        Schema::table('sector', function (Blueprint $table) {
            $table->dropForeign(['picture_id']);
        });

        // Janres table
        Schema::table('janres', function (Blueprint $table) {
            $table->dropForeign(['picture_id']);
        });

        // Committents table
        Schema::table('committents', function (Blueprint $table) {
            $table->dropForeign(['picture_id']);
        });

        // Creators table
        Schema::table('creators', function (Blueprint $table) {
            $table->dropForeign(['picture_id']);
        });

        // Picture Janre table
        Schema::table('picture_janre', function (Blueprint $table) {
            $table->dropForeign(['picture_id']);
            $table->dropForeign(['janre_id']);
        });

        // Creators Pictures table
        Schema::table('_creators_pictures', function (Blueprint $table) {
            $table->dropForeign(['picture_id']);
            $table->dropForeign(['creator_id']);
        });
    }
}
