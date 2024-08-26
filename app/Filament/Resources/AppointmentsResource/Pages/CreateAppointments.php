<?php

namespace App\Filament\Resources\AppointmentsResource\Pages;

use App\Filament\Resources\AppointmentsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateAppointments extends CreateRecord
{
    protected static string $resource = AppointmentsResource::class;

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Appointment Created';
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
        ->success()
        ->title('Appointment Created')
        ->body('Appointment has been created successfully');
    }
}
