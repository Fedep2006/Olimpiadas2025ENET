<?php

use Illuminate\Container\Attributes\Log;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('records:update-old')->daily()->at('02:00');
// Ejecutar cada hora
Schedule::command('reservas:update-completed')
    ->hourly()
    ->withoutOverlapping(120) // Timeout de 2 minutos
    ->runInBackground()
    ->onSuccess(function () {
        FacadesLog::info('UpdateCompletedReservations schedule ejecutado con éxito');
    })
    ->onFailure(function () {
        FacadesLog::error('UpdateCompletedReservations schedule falló');
    });
Schedule::command('reservas:update-cancelled')
    ->hourly()
    ->withoutOverlapping(120)
    ->runInBackground()
    ->onSuccess(function () {
        FacadesLog::info('UpdateCancelledReservations schedule ejecutado con éxito');
    })
    ->onFailure(function () {
        FacadesLog::error('UpdateCancelledReservations schedule falló');
    });
