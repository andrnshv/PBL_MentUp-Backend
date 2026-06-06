<?php

namespace App\Filament\Resources\AdminEarnings;

use App\Filament\Resources\AdminEarnings\Pages\ListAdminEarnings;
use App\Filament\Resources\AdminEarnings\Tables\AdminEarningsTable;
use App\Models\MentorEarning;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AdminEarningResource extends Resource
{
    protected static ?string $model = MentorEarning::class;

    protected static ?string $navigationLabel = 'Admin Earnings';

    protected static ?string $modelLabel = 'Admin Earning';

    protected static ?int $navigationSort = 12;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedBanknotes;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with([
                'mentor',
                'payment',
            ]);
    }

    public static function table(Table $table): Table
    {
        return AdminEarningsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAdminEarnings::route('/'),
        ];
    }
}