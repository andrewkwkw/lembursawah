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
                    ->maxSize(2048)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth('1200')
                    ->imageResizeTargetHeight('675')
                    ->directory('galleries')
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
