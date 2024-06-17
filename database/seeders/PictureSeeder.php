<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Picture;
use App\Models\Creator;
use App\Models\Janre;
use App\Models\Location;
use App\Models\Sector;
use App\Models\Comittent;

class PictureSeeder extends Seeder
{
    public function run()
    {
        $creatorIds = Creator::pluck('id')->toArray();
        $janreIds = Janre::pluck('id')->toArray();
        $locationIds = Location::pluck('id')->toArray();
        $sectorIds = Sector::pluck('id')->toArray();
        $comittentIds = Comittent::pluck('id')->toArray();

        Picture::create([
            'img' => 'https://media.walldeco.ua/wp-content/uploads/sites/17/20240509141555/mona-liza-1.jpg',
            'title' => 'ghdghdg',
            'creator_id' => null,
            'size' => '12x22',
            'description' => 'fgsedthedhgdrhdrdstsrxdhsr',
            'janre_id' => $janreIds[array_rand($janreIds)],
            'location_id' => $locationIds[array_rand($locationIds)],
            'sector_id' => $sectorIds[array_rand($sectorIds)],
            'comittent_id' => $comittentIds[array_rand($comittentIds)],
            'estimate' => '1234.33',
            'updated_at' => now(),
            'created_at' => now(),
        ]);

        Picture::factory()->count(10)->create([
            'creator_id' => $creatorIds[array_rand($creatorIds)],
            'janre_id' => $janreIds[array_rand($janreIds)],
            'location_id' => $locationIds[array_rand($locationIds)],
            'sector_id' => $sectorIds[array_rand($sectorIds)],
            'comittent_id' => $comittentIds[array_rand($comittentIds)],
        ]);
    }
}
