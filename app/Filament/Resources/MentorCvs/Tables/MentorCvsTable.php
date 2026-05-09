<?php

namespace App\Filament\Resources\MentorCvs\Tables;

use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class MentorCvsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_lengkap')
                    ->label('Nama Mentor')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable(),

                TextColumn::make('cv_url')
                    ->label('File CV')
                    ->formatStateUsing(fn ($state) => $state ? 'Lihat CV' : '-')
                    ->url(fn ($record) => $record->cv_url)
                    ->openUrlInNewTab()
                    ->color('info'),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'approved' => 'success',
                        'rejected' => 'danger',
                        'pending'  => 'warning',
                        default    => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Didaftarkan')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending'  => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->recordActions([
                Action::make('approve')
                    ->label('Konfirmasi')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi CV Mentor')
                    ->modalDescription('Apakah kamu yakin ingin menyetujui CV mentor ini?')
                    ->modalSubmitActionLabel('Ya, Setujui')
                    ->action(function ($record) {
                        DB::table('mentor_cv')
                            ->where('id', $record->id)
                            ->update(['status' => 'approved']);
                    }),

                Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->modalHeading('Tolak CV Mentor')
                    ->modalDescription('Apakah kamu yakin ingin menolak CV mentor ini?')
                    ->modalSubmitActionLabel('Ya, Tolak')
                    ->action(function ($record) {
                        DB::table('mentor_cv')
                            ->where('id', $record->id)
                            ->update(['status' => 'rejected']);
                    }),
            ])
            ->toolbarActions([]) // kosong — tidak ada bulk action
            ->defaultSort('created_at', 'desc');
    }
}