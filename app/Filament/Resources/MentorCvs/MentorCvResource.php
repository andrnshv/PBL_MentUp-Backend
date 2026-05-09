<?php

namespace App\Filament\Resources\MentorCvs;

use App\Filament\Resources\MentorCvs\Pages\ListMentorCvs;
use App\Filament\Resources\MentorCvs\Tables\MentorCvsTable;
use App\Models\MentorCv;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MentorCvResource extends Resource
{
    protected static ?string $model = MentorCv::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;
    protected static ?string $navigationLabel = 'Verifikasi CV Mentor';
    protected static ?string $modelLabel      = 'CV Mentor';
    protected static ?int $navigationSort = 2; // setelah Data User

    // Read only — aksi tulis dari tombol konfirmasi saja
    public static function canCreate(): bool { return false; }
    public static function canEdit($record): bool { return false; }
    public static function canDelete($record): bool { return false; }

    public static function table(Table $table): Table
    {
        return MentorCvsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMentorCvs::route('/'),
        ];
    }
}