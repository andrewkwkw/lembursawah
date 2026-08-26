<?php

namespace App\Filament\Resources\MapPoints\Pages;

use App\Filament\Resources\MapPoints\MapPointResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMapPoint extends EditRecord
{
    protected static string $resource = MapPointResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
