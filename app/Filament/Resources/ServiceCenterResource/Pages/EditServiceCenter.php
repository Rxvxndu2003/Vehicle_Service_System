<?php

namespace App\Filament\Resources\ServiceCenterResource\Pages;

use App\Filament\Resources\ServiceCenterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceCenter extends EditRecord
{
    protected static string $resource = ServiceCenterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
