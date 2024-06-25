<?php

namespace App\Filament\Widgets;

use App\Models\Cuenta;
use App\Models\FuenteIngreso;
use App\Models\Transaccion;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TransaccionOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Ingresos', Transaccion::query()->where('tipo_transaccion', 'Ingreso')->count())
                ->description('Numero total de ingresos')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Egresos', Transaccion::query()->where('tipo_transaccion', 'Egreso')->count())
                ->description('Numero total de egresos')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Cuentas', Cuenta::query()->count())
                ->description('Numero total de cuentas')
                ->descriptionIcon('heroicon-o-banknotes')
                ->color('info'),
            Stat::make('Fuentes de Ingreso', FuenteIngreso::query()->count())
                ->description('Numero de fuentes de ingreso')
                ->descriptionIcon('heroicon-c-wrench')
                ->color('info')
        ];
    }
}
