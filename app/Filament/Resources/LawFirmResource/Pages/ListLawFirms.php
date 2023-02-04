<?php

namespace App\Filament\Resources\LawFirmResource\Pages;

use App\Filament\Resources\LawFirmResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLawFirms extends ListRecords
{
    protected static string $resource = LawFirmResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
