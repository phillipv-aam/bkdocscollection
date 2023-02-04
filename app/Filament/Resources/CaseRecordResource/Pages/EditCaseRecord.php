<?php

namespace App\Filament\Resources\CaseRecordResource\Pages;

use App\Filament\Resources\CaseRecordResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCaseRecord extends EditRecord
{
    protected static string $resource = CaseRecordResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
