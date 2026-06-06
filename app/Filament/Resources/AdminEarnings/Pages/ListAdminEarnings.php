<?php

namespace App\Filament\Resources\AdminEarnings\Pages;

use App\Filament\Resources\AdminEarnings\AdminEarningResource;
use Filament\Resources\Pages\ListRecords;
use App\Models\MentorEarning;
use App\Filament\Widgets\AdminEarningStats; 

class ListAdminEarnings extends ListRecords
{
    protected static string $resource = AdminEarningResource::class;

    protected function getHeaderWidgets(): array
        {
            return [
                AdminEarningStats::class,
            ];
        }
}



