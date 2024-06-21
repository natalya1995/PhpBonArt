<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jewerly;

class JewerlySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jewerly::factory()->count(10)->create();
    }
}
