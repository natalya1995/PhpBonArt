<?php

namespace Database\Factories;
use App\Models\Auction;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition()
    {
        return [
            'auction_id' => Auction::factory(),
            'title' => $this->faker->word,
            'description' => $this->faker->sentence,
            'starting_price' => $this->faker->randomFloat(2, 10, 1000),
            'current_price' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
