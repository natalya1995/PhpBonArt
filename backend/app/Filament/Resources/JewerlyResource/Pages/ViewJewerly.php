<?php

namespace App\Filament\Resources\JewerlyResource\Pages;

use App\Filament\Resources\JewerlyResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJewerly extends ViewRecord
{
    protected static string $resource = JewerlyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
