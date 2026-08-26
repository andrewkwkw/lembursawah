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
                        'Restoran' => 'Restoran',
                    ])
                    ->nullable(),
                \Filament\Forms\Components\Select::make('difficulty')
                    ->label('Tingkat Kesulitan Akses')
                    ->options([
                        'Akses Kendaraan' => 'Akses Kendaraan',
                        'Jalan Santai' => 'Jalan Santai',
                        'Mendaki' => 'Mendaki',
                    ])
                    ->nullable(),
                RichEditor::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('Gambar Utama')
                    ->image()
                    ->maxSize(5120)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->directory('attractions')
                    ->imageEditor(),
                TextInput::make('link_url')
                    ->label('Tautan URL (Opsional)')
                    ->url(),
            ]);
    }
}
