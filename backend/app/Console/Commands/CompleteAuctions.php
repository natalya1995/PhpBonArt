<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Auction;
use App\Http\Controllers\AuctionController;

use Illuminate\Support\Facades\Http;

class CompleteAuctions extends Command
{
    protected $signature = 'auctions:complete';

    protected $description = 'Complete auctions that have ended';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        \Log::info('CompleteAuctions command is running.');
        $currentDateTime = now();

        $auctions = Auction::where('end_time', '<=', $currentDateTime)->get();

        foreach ($auctions as $auction) {
            $response = Http::post("http://backend:8080/api/auctions/{$auction->id}/complete");

            if ($response->successful()) {
                \Log::info("Auction {$auction->id} completed successfully.");
            } else {
                \Log::error("Failed to complete auction {$auction->id}. Response: " . $response->body());
            }
        }

        return 0;
    }
}
