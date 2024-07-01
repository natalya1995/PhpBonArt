<?php

namespace App\Filament\Resources\JanreResource\Pages;

use App\Filament\Resources\JanreResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJanres extends ListRecords
{
    protected static string $resource = JanreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
