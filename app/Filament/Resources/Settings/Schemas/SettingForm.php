<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('key')
                    ->label('Nama Pengaturan')
                    ->disabled()
                    ->required()
                    ->columnSpanFull()
                    ->hiddenOn('create'),
                TextInput::make('key')
                    ->label('Kunci Pengaturan')
                    ->required()
                    ->columnSpanFull()
                    ->visibleOn('create'),
                Textarea::make('value')
                    ->label('Nomor WhatsApp Admin (Awali dengan 62)')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('type')
                    ->label('Tipe Data')
                    ->required()
                    ->default('text')
                    ->hiddenOn('edit'),
            ]);
    }
}
