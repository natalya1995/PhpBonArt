<?php

namespace Database\Factories;

use App\Models\Jewerly;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jewelry>
 */
class JewerlyFactory extends Factory
{
    protected $model = Jewerly::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'img' => 'example.jpg', 
            'description' => $this->faker->paragraph,
            'estimate' => $this->faker->randomFloat(2, 10, 1000),
            'location_id' => function () {
                return \App\Models\Location::factory()->create()->id;
            },
        ];
    }
}
