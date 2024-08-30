<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserAppointmentResource\Pages;
use App\Filament\Resources\UserAppointmentResource\RelationManagers;
use App\Models\UserAppointment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserAppointmentResource extends Resource
{
    protected static ?string $model = UserAppointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Service Management';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('serviceCenter.service_center')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('services.service_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Columns\BooleanColumn::make('is_completed')
                    ->label('Completed')
                    ->sortable(),
            ])
            ->filters([
                Filter::make('is_featured')
                    ->toggle()
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Appointment Deleted.')
                            ->body('Appointment has been deleted successfully.')
                    ),
                Tables\Actions\Action::make('complete')
                    ->label('Complete')
                    ->action(function ($record) {
                        $record->update(['is_completed' => true]);
                        Notification::make()
                            ->success()
                            ->title('Appointment Completed')
                            ->body('The appointment has been marked as completed.')
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->color('success')
                    ->icon('heroicon-o-check')
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
            'index' => Pages\ListUserAppointments::route('/'),
            'edit' => Pages\EditUserAppointment::route('/{record}/edit'),
        ];
    }
}
