<?php

namespace App\Filament\Resources\MentorEarnings\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class MentorEarningsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('mentor_name')
                    ->label('Mentor')
                    ->state(fn ($record) => $record->mentor?->nama_lengkap),

                TextColumn::make('transaction_id')
                    ->label('Transaction ID')
                    ->state(fn ($record) => $record->payment?->transaction_id),

                TextColumn::make('gross_amount')
                    ->label('Gross Amount')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('platform_fee')
                    ->label('Platform Fee')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('net_amount')
                    ->label('Net Amount')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc');
    }
}