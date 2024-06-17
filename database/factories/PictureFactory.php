<?php
namespace Database\Factories;

use App\Models\Picture;
use App\Models\Creator;
use App\Models\Janre;
use App\Models\Location;
use App\Models\Sector;
use App\Models\Comittent;
use Illuminate\Database\Eloquent\Factories\Factory;

class PictureFactory extends Factory
{
    protected $model = Picture::class;

    public function definition()
    {
        return [
            'img' => $this->faker->imageUrl(),
            'title' => $this->faker->sentence(),
            'creator_id' => Creator::factory(), 
            'size' => $this->faker->randomElement(['small', 'medium', 'large']),
            'description' => $this->faker->paragraph(),
            'janre_id' => Janre::factory(),
            'location_id' => Location::factory(), 
            'sector_id' => Sector::factory(), 
            'comittent_id' => Comittent::factory(), 
            'estimate' => $this->faker->randomFloat(2, 1000, 10000)
        ];
    }
}
