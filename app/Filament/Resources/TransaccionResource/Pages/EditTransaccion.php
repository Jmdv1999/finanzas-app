<?php

namespace App\Filament\Resources\TransaccionResource\Pages;

use App\Filament\Resources\TransaccionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransaccion extends EditRecord
{
    protected static string $resource = TransaccionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
