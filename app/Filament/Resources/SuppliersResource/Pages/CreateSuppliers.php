<?php

namespace App\Filament\Resources\SuppliersResource\Pages;

use App\Filament\Resources\SuppliersResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateSuppliers extends CreateRecord
{
    protected static string $resource = SuppliersResource::class;

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Supplier Created';
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
        ->success()
        ->title('Supplier Created')
        ->body('Supplier has been created successfully');
    }
}
