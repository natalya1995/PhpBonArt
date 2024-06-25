<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Janre;

class JanreSeeder extends Seeder
{
    public function run()
    {
        Janre::factory()->count(5)->create();
    }
}
