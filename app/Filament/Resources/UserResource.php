<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('roles')
                    ->relationship('roles', 'name')
                    ->preload()
                    ->searchable(),
                TextInput::make('name')
                    ->label('Nama')
                    ->maxLength(255)
                    ->required(),
                TextInput::make('email')
                    ->label('Nama')
                    ->maxLength(255)
                    ->email()
                    ->required(),
                // Only considered dehydrated if its changed (filled)
                // Thus only get updated if there's a value during edit
                TextInput::make('password')
                    ->helperText('Minimal 6 Karakter')
                    ->hint('Saat Edit: Kosongkan jika tidak ingin diedit')
                    ->password()
                    ->revealable()
                    ->minLength(6)
                    ->maxLength(255)
                    ->required()
                    ->dehydrated(fn(?string $state): bool => filled($state))
                    ->required(fn(string $operation): bool => $operation === 'create')
                    ->default(''),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama/Email')
                    ->description(fn(User $record) => $record->email)
                    ->searchable(),
                TextColumn::make('roles')
                    ->label('Roles')
                    ->formatStateUsing(fn(User $record) => $record->getRoleNames()->join(','))
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Terakhir diperbaharui')
                    ->formatStateUsing(fn($state) => Carbon::parse($state)
                        ->setTimezone('Asia/Jakarta')
                        ->format('d M Y H:i'))
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUsers::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        // Hide their own account, and also super_admin accounts if a non-super_admin
        $user = auth()->user();
        $query = parent::getEloquentQuery();

        if ($user->hasRole('super_admin')) {
            return $query->where('id', '!=', $user->id);
        }

        if ($user->hasRole('Atom Admin')) {
            return $query
                ->where('id', '!=', $user->id)
                ->whereDoesntHave('roles', function ($q) {
                    $q->where('name', 'super_admin');
                });
        }

        return $query;
    }
}
