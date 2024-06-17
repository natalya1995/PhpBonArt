<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Janre;

class JanreFactory extends Factory
{
    protected $model = Janre::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'picture_id' => null, 
        ];
    }
}
