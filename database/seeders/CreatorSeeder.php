<?php

namespace Database\Seeders;
use App\Models\Creator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           Creator::create([
            'name' => 'John Doe',
            'YY' => '1814-1915',
            'biography' =>'dbfsdbfsbsfbsfbdfsfds',
            'picture_id' => null, 
        
        ]);

       
        Creator::factory()->count(10)->create();
    }
}
