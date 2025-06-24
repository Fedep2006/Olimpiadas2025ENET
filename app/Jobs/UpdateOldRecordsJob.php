<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Viaje;

class UpdateOldRecordsJob implements ShouldQueue
{
    use Queueable, SerializesModels, InteractsWithQueue;

    public function handle()
    {
        Viaje::whereDate('created_at', '<', now()->toDateString())
            ->update(['campo' => 'nuevo_valor']);
    }
}
