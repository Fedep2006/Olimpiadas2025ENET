<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateCompletedReservations extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'reservas:update-completed';

    /**
     * The console command description.
     */
    protected $description = 'Actualiza reservas a completado cuando la fecha de fin es anterior a hoy';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Iniciando actualización de reservas completadas...');

        $today = Carbon::today();

        // Buscar registros donde la fecha_fin sea anterior a hoy y el estado no sea 'completado'
        $reservasToUpdate = Reserva::where('fecha_fin', '<', $today)
            ->whereNotIn('estado', ['completada', 'cancelada', 'pendiente'])
            ->get();

        if ($reservasToUpdate->isEmpty()) {
            $this->info('No hay reservas para actualizar.');
            Log::info('UpdateCompletedReservations: No hay reservas para actualizar.');
            return self::SUCCESS;
        }

        // Mostrar detalles de las reservas que se van a actualizar
        $this->table(
            ['ID', 'Código', 'Fecha Fin', 'Estado Actual'],
            $reservasToUpdate->map(function ($reserva) {
                return [
                    $reserva->id,
                    $reserva->codigo_reserva,
                    $reserva->fecha_fin->format('Y-m-d'),
                    $reserva->estado
                ];
            })->toArray()
        );

        // Actualizar los registros
        $updated = Reserva::where('fecha_fin', '<', $today)
            ->whereNotIn('estado', ['completado', 'cancelado'])
            ->update([
                'estado' => 'completado'
            ]);

        $this->info("✅ Se actualizaron {$updated} reservas a estado 'completado'.");

        // Log detallado
        Log::info("UpdateCompletedReservations ejecutado exitosamente", [
            'reservas_actualizadas' => $updated,
            'fecha_ejecucion' => now(),
            'reservas_ids' => $reservasToUpdate->pluck('id')->toArray()
        ]);

        return self::SUCCESS;
    }
}
