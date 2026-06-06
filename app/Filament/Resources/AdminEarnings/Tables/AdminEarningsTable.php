<?php

namespace App\Filament\Resources\AdminEarnings\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class AdminEarningsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('payment.transaction_id')
                    ->label('Transaction ID')
                    ->searchable(),

                TextColumn::make('mentor.nama_lengkap')
                    ->label('Mentor')
                    ->searchable(),

                TextColumn::make('platform_fee')
                    ->label('Platform Fee')
                    ->badge()
                    ->color('success')
                    ->formatStateUsing(
                        fn ($state) =>
                        'Rp. ' . number_format($state, 0, ',', '.')
                    ),

                TextColumn::make('created_at')
                    ->label('Generated At')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

            ])
            ->defaultSort('created_at', 'desc');
    }
}