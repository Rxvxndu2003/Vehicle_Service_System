<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentsResource\Pages;
use App\Filament\Resources\AppointmentsResource\RelationManagers;
use App\Models\Appointments;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;

class AppointmentsResource extends Resource
{
    protected static ?string $model = Appointments::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Service Management';

    protected static ?string $recordTitleAttribute = 'customer_id';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'success';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Appointment Details')
                  ->description('Put the Appointment Details in.')
                  ->schema([
                       Forms\Components\Select::make('customer_id')
                           ->relationship(name: 'customer', titleAttribute: 'first_name')
                           ->searchable()
                           ->preload() 
                           ->required(),
                       Forms\Components\Select::make('service_center_id')
                           ->relationship(name: 'service_center', titleAttribute: 'service_center')
                           ->searchable()
                           ->preload() 
                           ->required(),
                       Forms\Components\Select::make('services_id')
                           ->relationship(name: 'services', titleAttribute: 'service_name')
                           ->searchable()
                           ->preload() 
                           ->required(),
                       Forms\Components\TextInput::make('location')
                           ->maxLength(255)
                           ->default(null)
                           ->required(),
                       Forms\Components\DatePicker::make('schedule_date')
                           ->required(),
                       Forms\Components\TimePicker::make('schedule_time')
                           ->required(),
                  ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.first_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('service_center.service_center')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('services.service_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('schedule_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('schedule_time'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('is_featured')
                     ->toggle()
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->successNotification(
                    Notification::make()
                       ->success()
                       ->title('Appointment Deleted.')
                       ->body('Appointment has been deleted successfully.')
                  )
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointments::route('/create'),
            'view' => Pages\ViewAppointments::route('/{record}'),
            'edit' => Pages\EditAppointments::route('/{record}/edit'),
        ];
    }
}
