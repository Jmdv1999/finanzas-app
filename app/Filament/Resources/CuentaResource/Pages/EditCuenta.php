<?php

namespace App\Filament\Resources\CuentaResource\Pages;

use App\Filament\Resources\CuentaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCuenta extends EditRecord
{
    protected static string $resource = CuentaResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
