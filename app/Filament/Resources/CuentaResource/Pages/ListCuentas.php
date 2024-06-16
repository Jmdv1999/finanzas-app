<?php

namespace App\Filament\Resources\CuentaResource\Pages;

use App\Filament\Resources\CuentaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCuentas extends ListRecords
{
    protected static string $resource = CuentaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
