<?php

namespace App\Filament\Resources\MapPoints\Pages;

use App\Filament\Resources\MapPoints\MapPointResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMapPoints extends ListRecords
{
    protected static string $resource = MapPointResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
