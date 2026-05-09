<?php

namespace App\Filament\Resources\Appusers\Pages;

use App\Filament\Resources\Appusers\AppuserResource;
use Filament\Resources\Pages\ListRecords;

class ListAppusers extends ListRecords
{
    protected static string $resource = AppuserResource::class;

    protected function getHeaderActions(): array
    {
        return []; // tidak ada tombol New
    }
}