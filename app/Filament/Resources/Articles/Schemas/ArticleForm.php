<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Artikel')
                    ->required(),
                TextInput::make('slug')
                    ->label('Slug URL')
                    ->required(),
                TextInput::make('author_name')
                    ->label('Nama Penulis')
                    ->default('Admin')
                    ->placeholder('Misal: Budi / Admin')
                    ->required(),
                TextInput::make('category')
                    ->label('Kategori')
                    ->placeholder('mis: Alam, Budaya, Kuliner, Berita'),
                Toggle::make('is_featured')
                    ->label('Jadikan Artikel Utama (Banner)'),
                RichEditor::make('content')
                    ->label('Isi Konten')
                    ->required()
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
                Toggle::make('is_published')
                    ->label('Terbitkan')
                    ->required(),
                DatePicker::make('published_at')
                    ->label('Diterbitkan Pada'),
            ]);
    }
}
