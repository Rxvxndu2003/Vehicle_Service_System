<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuppliersResource\Pages;
use App\Filament\Resources\SuppliersResource\RelationManagers;
use App\Models\Suppliers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;

class SuppliersResource extends Resource
{
    protected static ?string $model = Suppliers::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Resource Management';

    protected static ?string $recordTitleAttribute = 'supplier_name';

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
                Forms\Components\Section::make('Personal Details')
                  ->description('Put the Contact Name Details in.')
                  ->schema([
                    Forms\Components\TextInput::make('supplier_name')
                       ->maxLength(255)
                       ->default(null)
                       ->required(),
                    Forms\Components\TextInput::make('supplier_email')
                       ->email()
                       ->maxLength(255)
                       ->default(null)
                       ->required(),
                    Forms\Components\TextInput::make('supplier_phone')
                       ->tel()
                       ->maxLength(255)
                       ->default(null)
                       ->required(),
                    Forms\Components\TextInput::make('supplier_address')
                       ->maxLength(255)
                       ->default(null)
                       ->required(),
                  ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('supplier_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('supplier_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('supplier_phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('supplier_address')
                    ->searchable(),
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
                       ->title('Supplier Deleted.')
                       ->body('Supplier has been deleted successfully.')
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
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSuppliers::route('/create'),
            'view' => Pages\ViewSuppliers::route('/{record}'),
            'edit' => Pages\EditSuppliers::route('/{record}/edit'),
        ];
    }
}
