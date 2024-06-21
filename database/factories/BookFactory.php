<?php
namespace Database\Factories;

use App\Models\Book;
use App\Models\Creator;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'img' => $this->faker->imageUrl(),
            'creator_id' => Creator::factory(),
            'description' => $this->faker->paragraph,
            'num_pages' => $this->faker->numberBetween(100, 500),
            'num_copy' => $this->faker->numberBetween(1, 50),
            'estimate' => $this->faker->numberBetween(10, 100),
            'location_id' => Location::factory(),
        ];
    }
}

