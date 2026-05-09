<?php

namespace App\Filament\Resources\Appusers\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AppusersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('username')
                    ->label('Username')
                    ->searchable(),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'klien'  => 'success',
                        'mentor' => 'warning',
                        default  => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Terdaftar')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->options([
                        'klien'  => 'Klien',
                        'mentor' => 'Mentor',
                    ]),
            ])
            ->recordActions([])  // tidak ada action
            ->toolbarActions([]) // tidak ada bulk action
            ->defaultSort('created_at', 'desc');
    }
}