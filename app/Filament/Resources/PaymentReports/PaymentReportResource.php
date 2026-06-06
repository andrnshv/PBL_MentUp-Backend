<?php

namespace App\Filament\Resources\PaymentReports;

use App\Filament\Resources\PaymentReports\Pages\ListPaymentReports;
use App\Filament\Resources\PaymentReports\Tables\PaymentReportsTable;
use App\Models\Payment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PaymentReportResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationLabel = 'Payment Reports';

    protected static ?string $modelLabel = 'Payment Report';

    protected static ?int $navigationSort = 10;

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
    return parent::getEloquentQuery();
}

    public static function table(Table $table): Table
    {
        return PaymentReportsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPaymentReports::route('/'),
        ];
    }
}