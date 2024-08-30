<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\UserAppointment;

class UserAppointments extends BaseWidget
{
    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(UserAppointment::query())
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('full_name'),
                Tables\Columns\TextColumn::make('schedule_date'),
                Tables\Columns\TextColumn::make('schedule_time'),
                Tables\Columns\BooleanColumn::make('is_completed'),
            ]);
    }
}
