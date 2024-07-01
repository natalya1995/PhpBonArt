<?php

namespace App\Filament\Resources\ComittentResource\Pages;

use App\Filament\Resources\ComittentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListComittents extends ListRecords
{
    protected static string $resource = ComittentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
