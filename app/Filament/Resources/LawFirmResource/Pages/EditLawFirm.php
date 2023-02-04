<?php

namespace App\Filament\Resources\LawFirmResource\Pages;

use App\Filament\Resources\LawFirmResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLawFirm extends EditRecord
{
    protected static string $resource = LawFirmResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
