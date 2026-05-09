<?php

namespace App\Filament\Resources\Appusers\Pages;

use App\Filament\Resources\Appusers\AppuserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAppuser extends EditRecord
{
    protected static string $resource = AppuserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
