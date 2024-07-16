<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeudaResource\Pages;
use App\Filament\Resources\DeudaResource\RelationManagers;
use App\Models\Cuenta;
use App\Models\Deuda;
use App\Models\Transaccion;
use Filament\Actions\Action as ActionsAction;
use Filament\Actions\Modal\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DeudaResource extends Resource
{
    protected static ?string $model = Deuda::class;

    protected static ?string $navigationGroup = 'Financiero';
    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-down';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('acreedor')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('monto')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\Textarea::make('descripcion')
                    ->required()
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('acreedor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('monto')
                    ->numeric()
                    ->sortable()
                    ->prefix('$'),
                Tables\Columns\TextColumn::make('estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pendiente' => 'warning',
                        'exonerada' => 'gray',
                        'pagada' => 'success'
                    }),
                Tables\Columns\TextColumn::make('descripcion')
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
                Tables\Actions\Action::make('marcarComoPagada')
                    ->label('Pagada')
                    ->icon('heroicon-o-banknotes')
                    ->form([
                        Select::make('cuenta_id')
                            ->label('Cuenta')
                            ->options(Cuenta::all()->pluck('nombre', 'id')->toArray())
                            ->required()
                            ->searchable()
                            ->preload(),
                        TextInput::make('monto')
                            ->label('Monto a Pagar')
                            ->numeric()
                            ->required()
                            ->rule(function ($record) {
                                return [
                                    'max:' . $record->monto
                                ];
                            })

                    ])
                    ->action(function ($record, $data) {
                        $record->monto -= $data['monto'];
                        if ($record->monto <= 0) {
                            $record->estado = 'pagada';
                            $record->monto = 0; // Asegurarse de que el monto no sea negativo
                        }
                        $record->save();

                        Transaccion::create([
                            "monto" => $data['monto'],
                            "concepto" => "pago de deuda " . $record->id . " por concepto de " . $record->descripcion,
                            "tipo_transaccion" => "Egreso",
                            "cuenta_id" => $data["cuenta_id"]
                        ]);
                    })
                    ->requiresConfirmation()
                    ->color('success')
                    ->visible(fn ($record) => $record->estado === 'pendiente'),

                Tables\Actions\Action::make('marcarComoExonerada')
                    ->label('Exonerada')
                    ->icon('heroicon-o-banknotes')
                    ->action(function ($record) {
                        $record->estado = 'exonerada';
                        $record->save();
                    })
                    ->requiresConfirmation()
                    ->color('success')
                    ->visible(fn ($record) => $record->estado === 'pendiente'),
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
            'index' => Pages\ListDeudas::route('/'),
            'create' => Pages\CreateDeuda::route('/create'),
            'edit' => Pages\EditDeuda::route('/{record}/edit'),
        ];
    }
}
