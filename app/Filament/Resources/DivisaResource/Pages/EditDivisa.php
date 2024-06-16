<?php

namespace App\Filament\Resources\DivisaResource\Pages;

use App\Filament\Resources\DivisaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDivisa extends EditRecord
{
    protected static string $resource = DivisaResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
