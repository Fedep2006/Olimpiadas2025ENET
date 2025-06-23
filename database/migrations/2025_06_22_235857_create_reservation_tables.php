<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabla para reservas de hospedajes
        Schema::create('reserva_hospedajes', function (Blueprint $table) {
            // Campos del servicio original
            $table->id();
            $table->string('nombre')->comment('Nombre comercial del establecimiento');
            $table->foreignId('hospedaje_id')->constrained('hospedajes')->onDelete('cascade');
            $table->enum('tipo', ['hotel', 'hostal', 'apartamento', 'casa', 'cabaña', 'resort']);
            $table->enum('habitacion', ['individual', 'doble', 'triple', 'cuadruple', 'suite', 'familiar']);
            $table->integer('cantidad_habitaciones')->comment('Número de habitaciones reservadas');
            $table->integer('capacidad_personas');
            $table->decimal('precio_por_noche', 10, 2);
            $table->foreignId('pais_id')->constrained('paises')->onDelete('cascade');
            $table->foreignId('provincia_id')->constrained('provincias')->onDelete('cascade');
            $table->foreignId('ciudad_id')->constrained('ciudades')->onDelete('cascade');
            $table->string('ubicacion');
            $table->date('fecha_entrada');
            $table->date('fecha_salida');
            
            // Campos específicos de la reserva
            $table->foreignId('pago_id')->nullable()->constrained('pagos')->onDelete('set null');
            $table->enum('estado', ['pendiente', 'aceptado', 'rechazado'])->default('pendiente');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('notas')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabla para reservas de viajes
        Schema::create('reserva_viajes', function (Blueprint $table) {
            // Campos del servicio original
            $table->id();
            $table->string('nombre')->comment('Nombre o descripción del viaje');
            $table->foreignId('viaje_id')->constrained('viajes')->onDelete('cascade');
            $table->enum('tipo', ['bus', 'avion', 'tren', 'crucero']);
            $table->bigInteger('origen');
            $table->bigInteger('destino');
            $table->foreignId('pais_id')->constrained('paises')->onDelete('cascade');
            $table->foreignId('provincia_id')->constrained('provincias')->onDelete('cascade');
            $table->foreignId('ciudad_id')->constrained('ciudades')->onDelete('cascade');
            $table->string('ubicacion');
            $table->dateTime('fecha_salida');
            $table->dateTime('fecha_llegada');
            $table->string('numero_viaje');
            $table->integer('cantidad_pasajes');
            $table->decimal('precio_unitario', 10, 2);
            
            // Campos específicos de la reserva
            $table->foreignId('pago_id')->nullable()->constrained('pagos')->onDelete('set null');
            $table->enum('estado', ['pendiente', 'aceptado', 'rechazado'])->default('pendiente');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('notas')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabla para reservas de vehículos
        Schema::create('reserva_vehiculos', function (Blueprint $table) {
            // Campos del servicio original
            $table->id();
            $table->enum('tipo', ['auto', 'camioneta', 'moto', 'bicicleta']);
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->onDelete('cascade');
            $table->string('marca');
            $table->string('modelo');
            $table->string('antiguedad');
            $table->string('patente', 10);
            $table->string('color');
            $table->integer('capacidad_pasajeros');
            $table->foreignId('pais_id')->constrained('paises')->onDelete('cascade');
            $table->foreignId('provincia_id')->constrained('provincias')->onDelete('cascade');
            $table->foreignId('ciudad_id')->constrained('ciudades')->onDelete('cascade');
            $table->string('ubicacion');
            $table->decimal('precio_por_dia', 10, 2);
            $table->date('fecha_retiro');
            $table->date('fecha_devolucion');
            
            // Campos específicos de la reserva
            $table->foreignId('pago_id')->nullable()->constrained('pagos')->onDelete('set null');
            $table->enum('estado', ['pendiente', 'aceptado', 'rechazado'])->default('pendiente');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('notas')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reserva_vehiculos');
        Schema::dropIfExists('reserva_viajes');
        Schema::dropIfExists('reserva_hospedajes');
    }
};
