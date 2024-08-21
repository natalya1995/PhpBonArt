<?php

namespace Tests\Unit;

use App\Models\Bid;
use App\Models\User;
use App\Models\Auction;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BidTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_bid()
    {
        $user = User::factory()->create();
        $auction = Auction::factory()->create();
        $item = Item::factory()->create();

        $bid = Bid::create([
            'auction_id' => $auction->id,
            'user_id' => $user->id,
            'item_id' => $item->id,
            //'amount' => 100.00,
            'bid_time' => now(),
        ]);

        $this->assertDatabaseHas('bids', [
            'auction_id' => $auction->id,
            'user_id' => $user->id,
            'item_id' => $item->id,
            //'amount' => 100.00,
       
        ]);
    }

    /** @test */
    public function it_belongs_to_an_auction()
    {
        $bid = Bid::factory()->create();

        $this->assertInstanceOf(Auction::class, $bid->auction);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $bid = Bid::factory()->create();

        $this->assertInstanceOf(User::class, $bid->user);
    }

    /** @test */
    public function it_belongs_to_an_item()
    {
        $bid = Bid::factory()->create();

        $this->assertInstanceOf(Item::class, $bid->item);
    }
}
