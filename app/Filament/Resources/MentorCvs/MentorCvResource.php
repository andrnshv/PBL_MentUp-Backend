<?php

namespace App\Filament\Resources\MentorCvs;

use App\Filament\Resources\MentorCvs\Pages\ListMentorCvs;
use App\Filament\Resources\MentorCvs\Tables\MentorCvsTable;
use App\Models\MentorCv;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use BackedEnum; // Tambahkan ini kembali

class MentorCvResource extends Resource
{
    protected static ?string $model = MentorCv::class;

    // Perbaiki tipe data properti di bawah ini agar sesuai dengan parent class
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationLabel = 'Verifikasi CV Mentor';
    protected static ?string $modelLabel      = 'CV Mentor';
    protected static ?int $navigationSort = 2;

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