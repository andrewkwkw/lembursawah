<?php

namespace App\Filament\Resources\TourPackages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class TourPackageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Paket Wisata')
                    ->required(),
                TextInput::make('slug')
                    ->label('Slug URL')
                    ->required(),
                RichEditor::make('description')
                    ->label('Deskripsi Lengkap')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('Gambar Paket')
                    ->image()
                    ->maxSize(5120)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->directory('tour-packages')
                    ->imageEditor(),
                TextInput::make('price')
                    ->label('Harga (Rupiah)')
                    ->required()
                    ->numeric()
                    ->default(0.0)
                    ->prefix('Rp'),
                TextInput::make('duration')
                    ->label('Durasi')
                    ->placeholder('mis: Setengah Hari (4 jam)'),
                TextInput::make('max_pax')
                    ->label('Maksimal Peserta (Pax)')
                    ->placeholder('mis: Maks 10 orang'),
                \Filament\Forms\Components\Toggle::make('is_popular')
                    ->label('Tandai Populer'),
                TextInput::make('features')
                    ->label('Fitur (Pisahkan dengan koma)'),
                TextInput::make('wa_number')
                    ->label('Nomor WhatsApp (Booking)'),
            ]);
    }
}
