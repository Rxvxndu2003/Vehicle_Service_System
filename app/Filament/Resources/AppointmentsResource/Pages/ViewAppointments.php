<?php

namespace App\Filament\Resources\AppointmentsResource\Pages;

use App\Filament\Resources\AppointmentsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAppointments extends ViewRecord
{
    protected static string $resource = AppointmentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
