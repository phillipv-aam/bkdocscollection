<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use Carbon\Carbon;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateClient extends CreateRecord
{
    protected static string $resource = ClientResource::class;

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'New Client Created! Confirmation email has been sent';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['password'] = Hash::make(strtolower(Carbon::now()->englishMonth) . Carbon::now()->year);
    
        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        return static::getModel()::create($data)->assignRole('Client');
    }
}
