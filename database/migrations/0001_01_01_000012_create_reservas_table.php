<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('paquete_id')->constrained('paquetes')->onDelete('cascade');
            $table->dateTime('fecha_inicio')->comment('Fecha y hora de inicio de la reserva');
            $table->dateTime('fecha_fin')->comment('Fecha y hora de finalización de la reserva');
            $table->enum('estado', ['pendiente', 'confirmada', 'cancelada', 'completada'])->default('pendiente')
                ->comment('Estado actual de la reserva: pendiente (recién creada), confirmada (pago verificado y verificada por un administrador), cancelada (anulada), completada (servicio realizado)');
            $table->decimal('precio_total', 10, 2)->comment('Precio total de la reserva en la moneda base del sistema');
            $table->string('codigo_reserva', 8)->unique()->comment('Código único de 8 caracteres para identificar la reserva');
            $table->json('servicios_paquetes')->nullable()->comment('true o false de que servicios estan incluidos');
            $table->json('servicios_hospedajes')->nullable()->comment('true o false de que servicios estan incluidos');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservas');
    }
};
