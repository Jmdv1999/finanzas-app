<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DivisaResource\Pages;
use App\Filament\Resources\DivisaResource\RelationManagers;
use App\Models\Divisa;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DivisaResource extends Resource
{
    protected static ?string $model = Divisa::class;

    protected static ?string $navigationIcon = 'heroicon-s-currency-dollar';
    protected static ?string $navigationGroup = 'Mis cosas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombre')
                    ->required()
                    ->maxLength(50),
                TextInput::make('codigo')
                    ->maxLength(5)
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')
                ->sortable()
                ->searchable(),
                TextColumn::make('codigo')
                ->sortable()
                ->searchable(),
                
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make()->requiresConfirmation()
            ])
            ->bulkActions([
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
            'index' => Pages\ListDivisas::route('/'),
            'create' => Pages\CreateDivisa::route('/create'),
            'edit' => Pages\EditDivisa::route('/{record}/edit'),
        ];
    }
}
