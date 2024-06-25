<?php

namespace App\Filament\Resources\FuenteIngresoResource\Pages;

use App\Filament\Resources\FuenteIngresoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFuenteIngreso extends EditRecord
{
    protected static string $resource = FuenteIngresoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
