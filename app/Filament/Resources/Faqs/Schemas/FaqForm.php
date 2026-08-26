<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('question')
                    ->label('Pertanyaan')
                    ->required(),
                Textarea::make('answer')
                    ->label('Jawaban')
                    ->columnSpanFull(),
                Select::make('status')
                    ->label('Status')
                    ->options(['pending' => 'Menunggu (Pending)', 'approved' => 'Disetujui (Approved)'])
                    ->default('pending')
                    ->required(),
                TextInput::make('asked_by_name')
                    ->label('Ditanyakan Oleh (Nama)'),
            ]);
    }
}
