<?php

namespace App\Filament\Resources\MapPoints\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class MapPointForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Titik Lokasi')
                    ->required(),
                RichEditor::make('description')
                    ->label('Deskripsi Lokasi')
                    ->columnSpanFull(),
                TextInput::make('coordinate_x')
                    ->label('Garis Lintang (Coordinate X)'),
                TextInput::make('coordinate_y')
                    ->label('Garis Bujur (Coordinate Y)'),
                Textarea::make('street_view_embed_url')
                    ->label('Tautan Semat (Embed) Google Maps / Street View (HTML Iframe)')
                    ->hint('Buka Google Maps -> Bagikan -> Sematkan Peta -> Salin HTML')
                    ->columnSpanFull(),
            ]);
    }
}
