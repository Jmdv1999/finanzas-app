<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaccionResource\Pages;
use App\Filament\Resources\TransaccionResource\RelationManagers;
use App\Models\Transaccion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransaccionResource extends Resource
{
    protected static ?string $model = Transaccion::class;

    protected static ?string $navigationIcon = 'heroicon-m-arrows-right-left';
    protected static ?string $navigationLabel = 'Transacciones';
    protected static ?string $pluralModelLabel = 'Transacciones';

    protected static ?string $navigationGroup = 'Financiero';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('monto')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('concepto')
                    ->required()
                    ->maxLength(100),
                Forms\Components\Select::make('tipo_transaccion')
                    ->required()
                    ->options([
                        'Ingreso' => 'Ingreso',
                        'Egreso' => 'Egreso'
                    ])
                    ->preload()
                    ,
                Forms\Components\Select::make('cuenta_id')
                    ->required()
                    ->relationship('cuentas', 'nombre')
                    ->searchable()
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('monto')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tipo_transaccion'),
                Tables\Columns\TextColumn::make('cuentas.nombre')
                    ->numeric()
                    ->sortable()
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
            'index' => Pages\ListTransaccions::route('/'),
            'create' => Pages\CreateTransaccion::route('/create'),
            'edit' => Pages\EditTransaccion::route('/{record}/edit'),
        ];
    }
}
