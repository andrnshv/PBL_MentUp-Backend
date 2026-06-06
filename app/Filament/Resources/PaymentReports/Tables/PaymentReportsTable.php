<?php

namespace App\Filament\Resources\PaymentReports\Tables;

use App\Models\MentorEarning;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('transaction_id')
                    ->label('Transaction ID'),

                TextColumn::make('mentor_name')
                    ->label('Mentor')
                    ->state(
                        fn ($record) =>
                        $record->booking?->mentor?->nama_lengkap
                    ),

                TextColumn::make('client_name')
                    ->label('Client')
                    ->state(
                        fn ($record) =>
                        $record->booking?->client?->nama_lengkap
                    ),

            TextColumn::make('payment_status')
                ->label('Payment Status')
                ->badge()
                ->color(function ($state) {
                    return match ($state) {
                        'paid' => 'success',
                        'pending' => 'warning',
                        'failed' => 'danger',
                        'expired' => 'gray',
                        default => 'gray',
                    };
                }),

                TextColumn::make('booking_status')
                    ->label('Booking Status')
                    ->state(fn ($record) => $record->booking?->booking_status)
                    ->badge()
                    ->color(function ($state) {
                        return match ($state) {
                            'pending' => 'warning',
                            'paid' => 'info',
                            'confirmed' => 'primary',
                            'awaiting_verification' => 'warning',
                            'done' => 'success',
                            'completed' => 'success',
                            'rejected' => 'danger',
                            'cancelled' => 'gray',
                            'failed' => 'danger',
                            'reschedule' => 'purple',
                            default => 'gray',
                        };
                    }),

                TextColumn::make('amount')
                    ->label('Amount')
                    ->formatStateUsing(
                        fn ($state) => 'Rp. ' . number_format($state, 0, ',', '.')
                    ),

                TextColumn::make('paid_at')
                    ->label('Paid At')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                TextColumn::make('earning_status')
                    ->label('Earning Status')
                    ->state(function ($record) {
                        return MentorEarning::where(
                            'payment_id',
                            $record->id
                        )->exists()
                            ? 'Generated'
                            : 'Pending';
                    })
                    ->badge()
                    ->color(function ($state) {
                        return match ($state) {
                            'Generated' => 'success',
                            'Pending' => 'warning',
                            default => 'gray',
                        };
                    }),

            ])

            ->actions([

                Action::make('generate_earning')
                    ->label('Generate Earnings')
                    ->icon('heroicon-o-banknotes')
                    ->color('success')

                    ->visible(function ($record) {

                        $alreadyGenerated = MentorEarning::where(
                            'payment_id',
                            $record->id
                        )->exists();

                        return
                            $record->booking?->booking_status === 'completed'
                            && ! $alreadyGenerated;
                    })

                    ->requiresConfirmation()

                    ->modalHeading('Generate Mentor Earnings')

                    ->modalDescription(
                        'Buat data pendapatan mentor dari pembayaran ini?'
                    )

                    ->action(function ($record) {

                        if (
                            $record->booking?->booking_status !== 'completed'
                        ) {

                            Notification::make()
                                ->title('Booking belum completed')
                                ->danger()
                                ->send();

                            return;
                        }

                        MentorEarning::create([
                            'mentor_id'    => $record->booking->mentor_id,
                            'payment_id'   => $record->id,
                            'gross_amount' => $record->amount,
                            'platform_fee' => $record->amount * 0.10,
                            'net_amount'   => $record->amount * 0.90,
                        ]);

                        Notification::make()
                            ->title('Mentor earnings berhasil dibuat')
                            ->success()
                            ->send();
                    }),

            ])

            ->defaultSort('paid_at', 'desc');
    }
}