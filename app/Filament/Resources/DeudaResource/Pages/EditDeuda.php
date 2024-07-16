<?php

namespace App\Filament\Resources\DeudaResource\Pages;

use App\Filament\Resources\DeudaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDeuda extends EditRecord
{
    protected static string $resource = DeudaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
