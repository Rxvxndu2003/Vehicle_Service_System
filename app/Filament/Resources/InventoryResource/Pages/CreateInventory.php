<?php

namespace App\Filament\Resources\InventoryResource\Pages;

use App\Filament\Resources\InventoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateInventory extends CreateRecord
{
    protected static string $resource = InventoryResource::class;

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Product Created';
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
        ->success()
        ->title('Product Created')
        ->body('Product has been created successfully');
    }
}
