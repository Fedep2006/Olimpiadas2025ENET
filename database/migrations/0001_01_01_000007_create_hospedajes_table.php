<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hospedajes', function (Blueprint $table) {
            $table->id();

            $table->string('nombre')->comment('Nombre comercial del establecimiento');
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade');
            $table->enum('tipo', ['hotel', 'hostal', 'apartamento', 'casa', 'cabaña', 'resort'])
                ->comment('Tipo de establecimiento de hospedaje');
            $table->enum('habitacion', ['individual', 'doble', 'triple', 'cuadruple', 'suite', 'familiar']);
            $table->integer('habitaciones_disponibles')->comment('Número de habitaciones iguales disponibles');
            $table->integer('capacidad_personas')->comment('Número máximo de personas que pueden ocupar la habitación');
            $table->decimal('precio_por_noche', 10, 2)->comment('Precio por noche en la moneda base del sistema');
            $table->foreignId('pais_id')->constrained('paises')->onDelete('cascade');
            $table->foreignId('provincia_id')->constrained('provincias')->onDelete('cascade');
            $table->foreignId('ciudad_id')->constrained('ciudades')->onDelete('cascade');
            $table->string('ubicacion')->comment('Ubicación fisica del establecimiento');
            $table->integer('estrellas')->nullable()->comment('Clasificación del establecimiento (1 a 5 estrellas)');
            $table->text('descripcion')->nullable()->comment('Descripción detallada del establecimiento y sus instalaciones');
            $table->string('telefono')->nullable()->comment('Número de teléfono de contacto');
            $table->string('email')->nullable()->comment('Correo electrónico de contacto');
            $table->string('sitio_web')->nullable()->comment('URL del sitio web oficial');
            $table->time('check_in')->default('14:00:00')->comment('Hora estándar de check-in');
            $table->time('check_out')->default('12:00:00')->comment('Hora estándar de check-out');
            $table->decimal('calificacion', 3, 2)->nullable()->comment('Calificación promedio del establecimiento (0.00 a 5.00)');
            $table->boolean('activo')->default(true)->comment('Indica si la habitación está disponible para reserva');
            $table->string('condiciones')->comment('Condiciones del hospedaje');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hospedajes');
    }
};
