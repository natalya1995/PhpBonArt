<?php

namespace Database\Factories;
use App\Models\Creator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Creator>
 */
class CreatorFactory extends Factory
{
    protected $model = Creator::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'YY' => $this->faker->year,
            'biography' => $this->faker->paragraph,
            'picture_id' => null, 
        ];
    }
}