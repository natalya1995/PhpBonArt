<?php

namespace App\Filament\Resources\JewerlyResource\Pages;

use App\Filament\Resources\JewerlyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJewerly extends EditRecord
{
    protected static string $resource = JewerlyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
