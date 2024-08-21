<?php

namespace Database\Factories;

use App\Models\Bid;
use Illuminate\Database\Eloquent\Factories\Factory;

class BidFactory extends Factory
{
    protected $model = Bid::class;

    public function definition()
    {
        return [
            'auction_id' => \App\Models\Auction::factory(),
            'user_id' => \App\Models\User::factory(),
            'item_id' => \App\Models\Item::factory(),
            'amount' => $this->faker->randomFloat(2, 100, 10000),
            'bid_time' => $this->faker->dateTime(),
        ];
    }
}
