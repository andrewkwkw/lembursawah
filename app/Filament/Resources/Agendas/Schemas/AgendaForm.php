<?php

namespace App\Filament\Resources\Agendas\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class AgendaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Agenda')
                    ->required(),
                TextInput::make('slug')
                    ->label('Slug URL')
                    ->required(),
                \Filament\Forms\Components\Toggle::make('is_featured')
                    ->label('Tampilkan di Beranda (Featured)'),
                TextInput::make('category')
                    ->label('Kategori (mis: Workshop, Festival, Tur)'),
                TextInput::make('status')
                    ->label('Status (mis: Gratis, Penuh, Terbuka untuk Umum)'),
                TextInput::make('registration_url')
                    ->label('URL Pendaftaran / Link WhatsApp')
                    ->url(),
                RichEditor::make('description')
                    ->label('Deskripsi Lengkap')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('Gambar Agenda')
                    ->image()
                    ->maxSize(5120)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->directory('agendas')
                    ->imageEditor(),
                DateTimePicker::make('start_date')
                    ->label('Tanggal & Waktu Mulai')
                    ->required(),
                DateTimePicker::make('end_date')
                    ->label('Tanggal & Waktu Selesai'),
                TextInput::make('location')
                    ->label('Lokasi Acara'),
            ]);
    }
}
