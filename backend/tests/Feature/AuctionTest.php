<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Models\Auction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuctionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_auction()
    {
        $auction = Auction::factory()->create([
            'name' => 'Test Auction',
        ]);

        $this->assertDatabaseHas('auctions', [
            'name' => 'Test Auction',
        ]);
    }

    /** @test */
    public function it_can_update_an_auction()
    {
        $auction = Auction::factory()->create([
            'name' => 'Old Auction Name',
        ]);

        $auction->update(['name' => 'New Auction Name']);

        $this->assertDatabaseHas('auctions', [
            'name' => 'New Auction Name',
        ]);
    }

    /** @test */
    public function it_can_delete_an_auction()
    {
        $auction = Auction::factory()->create();

        $auction->delete();

        $this->assertDatabaseMissing('auctions', [
            'id' => $auction->id,
        ]);
    }

    /** @test */
    public function it_can_list_auctions()
    {
        Auction::factory()->count(5)->create();

        $auctions = Auction::all();

        $this->assertCount(5, $auctions);
    }
}