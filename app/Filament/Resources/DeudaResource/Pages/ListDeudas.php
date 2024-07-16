<?php

namespace App\Filament\Resources\DeudaResource\Pages;

use App\Filament\Resources\DeudaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDeudas extends ListRecords
{
    protected static string $resource = DeudaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
