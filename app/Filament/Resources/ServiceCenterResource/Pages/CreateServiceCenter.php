<?php

namespace App\Filament\Resources\ServiceCenterResource\Pages;

use App\Filament\Resources\ServiceCenterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateServiceCenter extends CreateRecord
{
    protected static string $resource = ServiceCenterResource::class;

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Service Center Created';
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
        ->success()
        ->title('Service Center Created')
        ->body('Service Center has been created successfully');
    }
}
