<?php

namespace App\Filament\Widgets;

use App\Models\MentorEarning;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminEarningStats extends BaseWidget
{
    protected function getStats(): array
    {
        $totalFee = MentorEarning::sum('platform_fee');

        return [
            Stat::make('Total Platform Fee', 'Rp. ' . number_format($totalFee, 0, ',', '.'))
                ->description('Pendapatan platform dari semua transaksi')
                ->color('success'),

        ];
    }
}