<?php

namespace App\Filament\Resources\FuenteIngresoResource\Pages;

use App\Filament\Resources\FuenteIngresoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFuenteIngresos extends ListRecords
{
    protected static string $resource = FuenteIngresoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
