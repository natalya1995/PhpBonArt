<?php

namespace Database\Factories;
use App\Models\Comittent;
use Illuminate\Database\Eloquent\Factories\Factory;


class ComittentFactory extends Factory
{
    protected $model = Comittent::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'IIN' => $this->faker->randomNumber(9, true),
            'num_udv' => $this->faker->randomNumber(9, true),
            'picture_id' => null, 
            'entry_price' => $this->faker->randomFloat(2, 100, 10000),
        ];
    }
}
