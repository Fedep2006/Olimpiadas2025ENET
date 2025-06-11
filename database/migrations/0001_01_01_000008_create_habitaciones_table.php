<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('habitaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hospedaje_id')->constrained('hospedajes')->onDelete('cascade')
                ->comment('ID del establecimiento al que pertenece la habitación');
            $table->string('numero')->comment('Número o identificador de la habitación');
            $table->enum('tipo', ['individual', 'doble', 'triple', 'cuadruple', 'suite', 'familiar'])
                ->comment('Tipo de habitación según su capacidad y características');
            $table->integer('capacidad_personas')->comment('Número máximo de personas que pueden ocupar la habitación');
            $table->decimal('precio_por_noche', 10, 2)->comment('Precio por noche en la moneda base del sistema');
            $table->decimal('precio_extra_persona', 10, 2)->nullable()->comment('Precio adicional por persona extra');
            $table->boolean('disponible')->default(true)->comment('Indica si la habitación está disponible para reserva');
            $table->json('caracteristicas')->nullable()->comment('Array de características de la habitación (ej: ["vista al mar", "balcón", "jacuzzi"])');
            $table->json('servicios')->nullable()->comment('Array de servicios específicos de la habitación (ej: ["minibar", "tv", "aire acondicionado"])');
            $table->json('camas')->nullable()->comment('Array de tipos de camas (ej: ["1 cama king", "2 camas individuales"])');
            $table->integer('metros_cuadrados')->nullable()->comment('Tamaño de la habitación en metros cuadrados');
            $table->json('imagenes')->nullable()->comment('Array de URLs de imágenes adicionales de la habitación');
            $table->text('descripcion')->nullable()->comment('Descripción detallada de la habitación');
            $table->json('politicas')->nullable()->comment('Array de políticas específicas de la habitación (ej: ["no fumadores", "solo adultos"])');
            $table->text('observaciones')->nullable()->comment('Notas adicionales sobre la habitación');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('habitaciones');
    }
};
