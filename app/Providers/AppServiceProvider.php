<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use App\Models\Reserva;
use App\Observers\ReservaObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Registrar observer para enviar correos luego de crear reservas
        Reserva::observe(ReservaObserver::class);

        Relation::morphMap([
            'viaje' => 'App\\Models\\Viaje',
            'vehiculo' => 'App\\Models\\Vehiculo',
            'hospedaje' => 'App\\Models\\Hospedaje',
        ]);
    }
}
