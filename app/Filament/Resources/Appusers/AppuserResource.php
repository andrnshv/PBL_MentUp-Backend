<?php

namespace App\Filament\Resources\Appusers;

use App\Filament\Resources\Appusers\Pages\ListAppusers;
use App\Filament\Resources\Appusers\Tables\AppusersTable;
use App\Models\Appuser;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AppuserResource extends Resource
{
    protected static ?string $model           = Appuser::class;
    protected static ?string $navigationLabel = 'Data User';
    protected static ?string $modelLabel      = 'User';
    protected static ?int    $navigationSort  = 1; // urutan di sidebar (sebelum MentorCv)
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    public static function canCreate(): bool        { return false; }
    public static function canEdit($record): bool   { return false; }
    public static function canDelete($record): bool { return false; }

    public static function table(Table $table): Table
    {
        return AppusersTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAppusers::route('/'),
        ];
    }
}