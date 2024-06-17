<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comittent;

class ComittentSeeder extends Seeder
{
    public function run()
    {
        Comittent::factory()->count(5)->create();
    }
}
