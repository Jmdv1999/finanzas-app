<?php

namespace App\Filament\Widgets;

use App\Models\Transaccion;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TransaccionOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Ingresos', Transaccion::query()->where('tipo_transaccion', 'Ingreso')->count())
                ->color('success')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Total Ingresos', Transaccion::query()->where('tipo_transaccion', 'Ingreso')->sum('monto'))
                ->color('success')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Egresos', Transaccion::query()->where('tipo_transaccion', 'Egreso')->count())
                ->color('danger')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Total Egresos', Transaccion::query()->where('tipo_transaccion', 'Egreso')->sum('monto'))
                ->color('danger')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}
