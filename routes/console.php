<?php

use App\Infrastructure\Productos\Models\Producto;
use App\Infrastructure\Usuarios\Models\User;
use App\Notifications\StockBajoNotification;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    $productosStockBajo = Producto::where('activo', true)
        ->whereColumn('stock_actual', '<=', 'stock_minimo')
        ->get();

    if ($productosStockBajo->isEmpty()) {
        return;
    }

    User::whereHas('role', fn ($q) => $q->where('nombre', 'Administrador'))
        ->get()
        ->each(fn ($admin) => $admin->notify(new StockBajoNotification($productosStockBajo)));

})->dailyAt('08:00')->name('check-stock-bajo')->withoutOverlapping();
