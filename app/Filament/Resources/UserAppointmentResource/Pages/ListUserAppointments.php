<?php

namespace App\Filament\Resources\UserAppointmentResource\Pages;

use App\Filament\Resources\UserAppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserAppointments extends ListRecords
{
    protected static string $resource = UserAppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
