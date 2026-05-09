<?php

namespace App\Filament\Resources\MentorCvs\Pages;

use App\Filament\Resources\MentorCvs\MentorCvResource;
use Filament\Resources\Pages\ListRecords;

class ListMentorCvs extends ListRecords
{
    protected static string $resource = MentorCvResource::class;

    protected function getHeaderActions(): array
    {
        return []; // kosong — tidak ada tombol New
    }
}