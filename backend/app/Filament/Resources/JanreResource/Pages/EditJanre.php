<?php

namespace App\Filament\Resources\JanreResource\Pages;

use App\Filament\Resources\JanreResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJanre extends EditRecord
{
    protected static string $resource = JanreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
