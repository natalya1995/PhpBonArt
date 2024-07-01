<?php

namespace App\Filament\Resources\ComittentResource\Pages;

use App\Filament\Resources\ComittentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditComittent extends EditRecord
{
    protected static string $resource = ComittentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
