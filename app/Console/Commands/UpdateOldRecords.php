<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TuModelo;
use App\Models\Viaje;

class UpdateOldRecords extends Command
{
    protected $signature = 'records:update-old';
    protected $description = 'Actualizar registros anteriores a hoy';

    public function handle()
    {
        $affected = Viaje::whereDate('fecha_salida', '<', now()->toDateString())
            ->update(['activo' => '0']);

        $this->info("Se actualizaron {$affected} registros");
    }
}
