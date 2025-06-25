<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateCancelledReservations extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'reservas:update-cancelled';

    /**
     * The console command description.
     */
    protected $description = 'Actualiza reservas pendientes a cancelado cuando la fecha de fin es anterior a hoy';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Iniciando cancelación de reservas pendientes vencidas...');

        $today = Carbon::today();

        // Buscar registros donde la fecha_fin sea anterior a hoy y el estado sea 'pendiente'
        $reservasToCancel = Reserva::where('fecha_fin', '<', $today)
            ->where('estado', 'pendiente')
            ->get();

        if ($reservasToCancel->isEmpty()) {
            $this->info('No hay reservas pendientes para cancelar.');
            Log::info('UpdateCancelledReservations: No hay reservas pendientes para cancelar.');
            return self::SUCCESS;
        }

        // Mostrar detalles de las reservas que se van a cancelar
        $this->table(
            ['ID', 'Código', 'Fecha Fin', 'Estado Actual', 'Días Vencidos'],
            $reservasToCancel->map(function ($reserva) use ($today) {
                $diasVencidos = $today->diffInDays($reserva->fecha_fin);
                return [
                    $reserva->id,
                    $reserva->codigo_reserva,
                    $reserva->fecha_fin->format('Y-m-d'),
                    $reserva->estado,
                    $diasVencidos . ' días'
                ];
            })->toArray()
        );

        // Confirmar antes de proceder (solo en modo interactivo)
        if ($this->input->isInteractive()) {
            if (!$this->confirm('¿Deseas cancelar estas reservas pendientes vencidas?')) {
                $this->info('Operación cancelada por el usuario.');
                return self::SUCCESS;
            }
        }

        // Actualizar los registros
        $cancelled = Reserva::where('fecha_fin', '<', $today)
            ->where('estado', 'pendiente')
            ->update([
                'estado' => 'cancelada',
                'updated_at' => now()
            ]);

        $this->info("❌ Se cancelaron {$cancelled} reservas pendientes vencidas.");

        // Log detallado
        Log::info("UpdateCancelledReservations ejecutado exitosamente", [
            'reservas_canceladas' => $cancelled,
            'fecha_ejecucion' => now(),
            'reservas_ids' => $reservasToCancel->pluck('id')->toArray(),
            'motivo' => 'Reservas pendientes con fecha_fin vencida'
        ]);

        return self::SUCCESS;
    }
}
