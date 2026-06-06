<?php

namespace App\Filament\Resources\MentorEarnings\Pages;

use App\Filament\Resources\MentorEarnings\MentorEarningResource;
use Filament\Resources\Pages\ListRecords;

class ListMentorEarnings extends ListRecords
{
    protected static string $resource = MentorEarningResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}