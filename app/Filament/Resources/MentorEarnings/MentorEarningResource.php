<?php

namespace App\Filament\Resources\MentorEarnings;

use App\Filament\Resources\MentorEarnings\Pages\ListMentorEarnings;
use App\Filament\Resources\MentorEarnings\Tables\MentorEarningsTable;
use App\Models\MentorEarning;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MentorEarningResource extends Resource
{
    protected static ?string $model = MentorEarning::class;

    protected static ?string $navigationLabel = 'Mentor Earnings';

    protected static ?string $modelLabel = 'Mentor Earning';

    protected static ?int $navigationSort = 11;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedCurrencyDollar;

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

    public static function table(Table $table): Table
    {
        return MentorEarningsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMentorEarnings::route('/'),
        ];
    }
}