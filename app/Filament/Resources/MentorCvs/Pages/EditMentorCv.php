<?php

namespace App\Filament\Resources\MentorCvs\Pages;

use App\Filament\Resources\MentorCvs\MentorCvResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMentorCv extends EditRecord
{
    protected static string $resource = MentorCvResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
