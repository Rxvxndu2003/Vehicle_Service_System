<?php

namespace App\Filament\Resources\ServicesResource\Pages;

use App\Filament\Resources\ServicesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateServices extends CreateRecord
{
    protected static string $resource = ServicesResource::class;

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Service Created';
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
        ->success()
        ->title('Service Created')
        ->body('Service has been created successfully');
    }
}
