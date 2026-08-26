<?php

namespace App\Filament\Resources\Attractions\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class AttractionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Tempat')
                    ->required(),
                \Filament\Forms\Components\Select::make('category')
                    ->label('Kategori')
                    ->options([
                        'Air Terjun / Alam' => 'Air Terjun / Alam',
                        'Persawahan' => 'Persawahan',
                        'Warisan Budaya' => 'Warisan Budaya',
                    ])
                    ->nullable(),
                \Filament\Forms\Components\Select::make('difficulty')
                    ->label('Tingkat Kesulitan Akses')
                    ->options([
                        'Jalan Santai (Mudah)' => 'Jalan Santai (Mudah)',
                        'Mendaki (Sedang)' => 'Mendaki (Sedang)',
                    ])
                    ->nullable(),
                RichEditor::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('Gambar Utama')
                    ->image()
                    ->maxSize(2048)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth('1200')
                    ->imageResizeTargetHeight('675'),
                TextInput::make('link_url')
                    ->label('Tautan URL (Opsional)')
                    ->url(),
            ]);
    }
}
