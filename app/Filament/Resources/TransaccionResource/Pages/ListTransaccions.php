<?php

namespace App\Filament\Resources\TransaccionResource\Pages;

use App\Filament\Resources\TransaccionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransaccions extends ListRecords
{
    protected static string $resource = TransaccionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
