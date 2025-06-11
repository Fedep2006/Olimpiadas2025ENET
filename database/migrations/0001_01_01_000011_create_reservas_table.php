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
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade')
                ->comment('ID del usuario que realiza la reserva');
            $table->enum('tipo', ['hospedaje', 'viaje', 'vehiculo', 'paquete'])
                ->comment('Tipo de reserva realizada');
            $table->unsignedBigInteger('servicio_id')
                ->comment('ID del servicio reservado (hospedaje_id, viaje_id, vehiculo_id o paquete_id)');
            $table->dateTime('fecha_inicio')->comment('Fecha y hora de inicio de la reserva');
            $table->dateTime('fecha_fin')->comment('Fecha y hora de finalización de la reserva');
            $table->string('ubicacion')->comment('Ubicación principal o punto de encuentro');
            $table->enum('estado', ['pendiente', 'confirmada', 'cancelada', 'completada'])->default('pendiente')
                ->comment('Estado actual de la reserva: pendiente (recién creada), confirmada (pago verificado), cancelada (anulada), completada (servicio realizado)');
            $table->json('personas_id')->comment('Array de IDs de la tabla personas que participarán');
            $table->json('habitaciones_id')->nullable()->comment('Array de IDs de las habitaciones reservadas (solo para reservas de tipo hospedaje)');
            $table->decimal('precio_total', 10, 2)->comment('Precio total de la reserva en la moneda base del sistema');
            $table->string('codigo_reserva', 8)->unique()->comment('Código único de 8 caracteres para identificar la reserva');
            $table->text('observaciones')->nullable()->comment('Notas adicionales sobre la reserva o requerimientos especiales');
            $table->string('metodo_pago')->nullable()->comment('Método de pago utilizado (efectivo, tarjeta, transferencia, etc.)');
            $table->boolean('pagado')->default(false)->comment('Indica si la reserva ha sido pagada completamente');
            $table->date('fecha_pago')->nullable()->comment('Fecha en que se realizó el pago de la reserva');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservas');
    }
};
