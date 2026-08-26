<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Produk')
                    ->required(),
                TextInput::make('slug')
                    ->label('Slug URL')
                    ->required(),
                RichEditor::make('description')
                    ->label('Deskripsi Lengkap')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('Gambar Produk')
                    ->image()
                    ->maxSize(5120)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->directory('products')
                    ->imageEditor(),
                TextInput::make('price')
                    ->label('Harga (Rupiah)')
                    ->required()
                    ->numeric()
                    ->default(0.0)
                    ->prefix('Rp'),
                TextInput::make('category')
                    ->label('Kategori')
                    ->placeholder('mis: Makanan Khas, Kerajinan Tangan'),
                TextInput::make('badge')
                    ->label('Lencana (Badge)')
                    ->placeholder('mis: Terlaris, Baru'),
                \Filament\Forms\Components\Toggle::make('is_featured')
                    ->label('Produk Unggulan (Banner)'),
                TextInput::make('wa_number')
                    ->label('Nomor WhatsApp (Pembelian)'),
            ]);
    }
}
