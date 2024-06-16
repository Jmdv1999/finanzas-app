<?php

namespace App\Filament\Resources\DivisaResource\Pages;

use App\Filament\Resources\DivisaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDivisas extends ListRecords
{
    protected static string $resource = DivisaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
