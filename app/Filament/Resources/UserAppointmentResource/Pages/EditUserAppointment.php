<?php

namespace App\Filament\Resources\UserAppointmentResource\Pages;

use App\Filament\Resources\UserAppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserAppointment extends EditRecord
{
    protected static string $resource = UserAppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
