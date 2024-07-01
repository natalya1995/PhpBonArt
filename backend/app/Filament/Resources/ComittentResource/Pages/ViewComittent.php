<?php

namespace App\Filament\Resources\ComittentResource\Pages;

use App\Filament\Resources\ComittentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewComittent extends ViewRecord
{
    protected static string $resource = ComittentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
