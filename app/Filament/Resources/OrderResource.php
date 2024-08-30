<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Filter;
use Filament\Notifications\Notification;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift-top';

    protected static ?string $navigationGroup = 'Service Management';

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
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('id')
                           ->sortable()
                           ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('full_name')
                           ->sortable()
                           ->searchable(),
            Tables\Columns\TextColumn::make('product.name')
                           ->sortable()
                           ->searchable(),
            Tables\Columns\TextColumn::make('email')
                           ->sortable()
                           ->searchable()
                           ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('address')
                           ->sortable()
                           ->searchable()
                           ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('postal_code')
                           ->sortable()
                           ->searchable()
                           ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('phone')
                           ->sortable()
                           ->searchable(),
            Tables\Columns\TextColumn::make('payment_details')
                           ->sortable()
                           ->searchable(),
            Tables\Columns\TextColumn::make('total')
                           ->sortable()
                           ->searchable(),
            Tables\Columns\BooleanColumn::make('is_completed')
                           ->label('Completed')
                           ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                           ->sortable()
                           ->toggleable(isToggledHiddenByDefault: true),
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
                   ->title('Order Deleted.')
                   ->body('Order has been deleted successfully.')
              ),
            Tables\Actions\Action::make('complete')
                ->label('Complete')
                ->action(function ($record) {
                    $record->update(['is_completed' => true]);
                    Notification::make()
                        ->success()
                        ->title('Order Completed')
                        ->body('The Order has been marked as completed.')
                        ->send();
                })
                ->requiresConfirmation()
                ->color('success')
                ->icon('heroicon-o-check'),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrders::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}


