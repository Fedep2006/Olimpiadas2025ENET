<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nombres_servicios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->comment('Nombre del servicio');
            $table->enum('tabla', ['hospedajes', 'viajes', 'paquetes'])
                ->comment('Tabla del servicio');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nombre_servicio_id')->constrained('servicios')->onDelete('cascade');
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade');
            $table->decimal('precio')->comment('Precio del servicio');
            $table->boolean('por_noche')->default(false)->comment('Indica si el servicio se paga por cada noche o no');
            $table->morphs('serviciable');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servicios');
        Schema::dropIfExists('servicios_precios');
    }
};
