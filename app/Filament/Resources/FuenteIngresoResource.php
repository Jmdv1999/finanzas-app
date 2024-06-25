<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FuenteIngresoResource\Pages;
use App\Filament\Resources\FuenteIngresoResource\RelationManagers;
use App\Models\FuenteIngreso;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FuenteIngresoResource extends Resource
{
    protected static ?string $model = FuenteIngreso::class;

    protected static ?string $navigationIcon = 'heroicon-c-wrench';
    protected static ?string $navigationLabel = 'Fuentes De Ingreso';
    protected static ?string $pluralModelLabel = 'Fuentes De Ingreso';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('mombre')
                    ->required()
                    ->maxLength(75),
                Forms\Components\TextInput::make('descripcion')
                    ->maxLength(150)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('descripcion')
                    ->searchable()
                    ->sortable(),
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
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListFuenteIngresos::route('/'),
            'create' => Pages\CreateFuenteIngreso::route('/create'),
            'edit' => Pages\EditFuenteIngreso::route('/{record}/edit'),
        ];
    }
}
