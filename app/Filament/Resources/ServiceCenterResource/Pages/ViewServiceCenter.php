<?php

namespace App\Filament\Resources\ServiceCenterResource\Pages;

use App\Filament\Resources\ServiceCenterResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewServiceCenter extends ViewRecord
{
    protected static string $resource = ServiceCenterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
