<?php

namespace App\Filament\Resources\JanreResource\Pages;

use App\Filament\Resources\JanreResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJanre extends ViewRecord
{
    protected static string $resource = JanreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
