<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Appointments;

class LatestAppointments extends BaseWidget
{
    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(Appointments::query())
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('customer.first_name'),
                Tables\Columns\TextColumn::make('location'),
                Tables\Columns\TextColumn::make('schedule_date'),
                Tables\Columns\TextColumn::make('schedule_time'),
            ]);
    }
}
