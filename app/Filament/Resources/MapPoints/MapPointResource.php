<?php

namespace App\Filament\Resources\MapPoints;

use App\Filament\Resources\MapPoints\Pages\CreateMapPoint;
use App\Filament\Resources\MapPoints\Pages\EditMapPoint;
use App\Filament\Resources\MapPoints\Pages\ListMapPoints;
use App\Filament\Resources\MapPoints\Schemas\MapPointForm;
use App\Filament\Resources\MapPoints\Tables\MapPointsTable;
use App\Models\MapPoint;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MapPointResource extends Resource
{
    protected static ?string $model = MapPoint::class;

    protected static ?string $modelLabel = 'Peta';
    protected static ?string $pluralModelLabel = 'Peta';
    protected static ?string $navigationLabel = 'Peta';
    protected static ?int $navigationSort = 8;

    
    
    
    

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return MapPointForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MapPointsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMapPoints::route('/'),
            'create' => CreateMapPoint::route('/create'),
            'edit' => EditMapPoint::route('/{record}/edit'),
        ];
    }
}
