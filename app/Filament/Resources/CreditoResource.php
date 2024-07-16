<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CreditoResource\Pages;
use App\Filament\Resources\CreditoResource\RelationManagers;
use App\Models\Credito;
use Filament\Forms;
use App\Models\Cuenta;
use App\Models\Transaccion;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CreditoResource extends Resource
{
    protected static ?string $model = Credito::class;

    protected static ?string $navigationGroup = 'Financiero';
    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-up';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('cliente')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('monto')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\Textarea::make('descripcion')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cliente')
                    ->searchable(),
                Tables\Columns\TextColumn::make('monto')
                    ->numeric()
                    ->sortable()
                    ->prefix('$'),
                Tables\Columns\TextColumn::make('estado')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pendiente' => 'warning',
                        'exonerado' => 'gray',
                        'pagado' => 'success'
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
                    ->label('Pagado')
                    ->icon('heroicon-o-banknotes')
                    ->form([
                        Select::make('cuenta_id')
                            ->label('Cuenta')
                            ->options(Cuenta::all()->pluck('nombre', 'id')->toArray())
                            ->required()
                            ->searchable()
                            ->preload(),
                    ])
                    ->action(function ($record, $data) {
                        $record->estado = 'pagado';
                        $record->save();

                        Transaccion::create([
                            "monto" => $record->monto,
                            "concepto" => "pago de credito " . $record->id . " por concepto de " . $record->descripcion,
                            "tipo_transaccion" => "Ingreso",
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
                        $record->estado = 'exonerado';
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
            'index' => Pages\ListCreditos::route('/'),
            'create' => Pages\CreateCredito::route('/create'),
            'edit' => Pages\EditCredito::route('/{record}/edit'),
        ];
    }
}
