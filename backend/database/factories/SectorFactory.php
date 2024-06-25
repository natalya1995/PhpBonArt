<?php

namespace Database\Factories;

use App\Models\Sector;
use App\Models\Picture;
use Illuminate\Database\Eloquent\Factories\Factory;

class SectorFactory extends Factory
{
    protected $model = Sector::class;

    public function definition()
    {
        return [
            'num' => $this->faker->numberBetween(1, 40),
        ];
    }
}
