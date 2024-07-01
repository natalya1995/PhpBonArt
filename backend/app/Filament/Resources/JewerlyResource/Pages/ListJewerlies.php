<?php

namespace App\Filament\Resources\JewerlyResource\Pages;

use App\Filament\Resources\JewerlyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJewerlies extends ListRecords
{
    protected static string $resource = JewerlyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
