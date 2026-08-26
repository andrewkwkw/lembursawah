<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul / Nama')
                    ->required(),
                Select::make('type')
                    ->label('Tipe Media')
                    ->options(['photo' => 'Foto', 'video' => 'Video'])
                    ->required()
                    ->live(),
                \Filament\Forms\Components\FileUpload::make('media_url')
                    ->label('Foto')
                    ->image()
                    ->maxSize(5120)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->directory('galleries')
                    ->imageEditor()
                    ->required()
                    ->visible(fn (\Filament\Schemas\Components\Utilities\Get $get) => $get('type') === 'photo'),
                TextInput::make('media_url')
                    ->label('Tautan YouTube')
                    ->url()
                    ->required()
                    ->visible(fn (\Filament\Schemas\Components\Utilities\Get $get) => $get('type') === 'video'),
                \Filament\Forms\Components\Textarea::make('description')
                    ->label('Deskripsi (Opsional)')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
