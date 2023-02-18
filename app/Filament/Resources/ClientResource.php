<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\LawFirm;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationLabel = 'My Clients';

    protected static ?string $slug = 'my-clients';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('email')->required()->unique(),
                Forms\Components\Select::make('law_firm')
                    ->label('Law Firm')
                    ->relationship('law_firms', 'name')
                    ->options(LawFirm::where('name', '!=', 'Super Admin')->pluck('name', 'id'))
                    ->multiple()
                    ->required()
                    ->searchable(),
                Forms\Components\DateTimePicker::make('expires_at')
                    ->withoutSeconds()
                    ->minutesStep(30),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TagsColumn::make('law_firms.name')
                    ->label('Law Firm'),
                    Tables\Columns\IconColumn::make('email_verified')
                    ->options([
                        'heroicon-o-x-circle',
                        'heroicon-o-check-circle' => fn ($state): bool => $state != NULL,
                    ])
                    ->colors([
                        'warning',
                        'success' => fn ($state): bool => $state != NULL,
                    ])
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('resend_email')
                    ->action(fn (User $record) => $record->resendEmail())
                    ->requiresConfirmation()
                    ->icon('heroicon-o-refresh')
                    ->color('success')
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->role('Client');
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
    
    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole(['Super Admin', 'Law Firm User']);
    }

    public function mount(): void
    {
        abort_unless(auth()->user()->hasRole(['Super Admin', 'Law Firm User']), 403);
    }
}
