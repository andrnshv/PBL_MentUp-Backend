<?php

namespace App\Filament\Resources\MentorCvs\Tables;

use App\Models\MentorCv;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

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
                    ->label('Email')
                    ->searchable(),

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
            ->actions([
                /*
                |--------------------------------------------------------------------------
                | Preview PDF CV
                |--------------------------------------------------------------------------
                */

                Action::make('view_pdf')
                    ->label('Lihat CV')
                    ->icon('heroicon-o-document-magnifying-glass')
                    ->color('info')
                    ->modalHeading('Pratinjau CV Mentor')
                    ->modalWidth('7xl')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup')
                    // Memastikan isi modal tidak terpotong oleh padding internal Filament
                    ->modalContent(
                        fn (MentorCv $record) => view(
                            'filament.components.pdf-viewer',
                            ['url' => $record->cv_url]
                        )
                    ),

                /*
                |--------------------------------------------------------------------------
                | Approve Mentor
                |--------------------------------------------------------------------------
                */
                Action::make('approve')
                    ->label('Konfirmasi')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (MentorCv $record) => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->modalHeading('Setujui Mentor')
                    ->modalDescription('Apakah Anda yakin ingin menyetujui pendaftaran mentor ini?')
                    ->action(function (MentorCv $record) {
                        $record->update(['status' => 'approved']);

                        Notification::make()
                            ->title('Mentor berhasil disetujui')
                            ->success()
                            ->send();
                    }),

                /*
                |--------------------------------------------------------------------------
                | Reject Mentor
                |--------------------------------------------------------------------------
                */
                Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (MentorCv $record) => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->modalHeading('Tolak Mentor')
                    ->modalDescription('Tindakan ini akan menolak pendaftaran mentor. Lanjutkan?')
                    ->action(function (MentorCv $record) {
                        $record->update(['status' => 'rejected']);

                        Notification::make()
                            ->title('Mentor telah ditolak')
                            ->danger()
                            ->send();
                    }),
            ])
            ->defaultSort('created_at', 'desc');
    }
}