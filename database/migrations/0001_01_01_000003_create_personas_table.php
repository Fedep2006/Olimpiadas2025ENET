<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->comment('Nombre de la persona');
            $table->string('apellido')->comment('Apellido de la persona');
            $table->string('dni', 20)->unique()->comment('Número de documento de identidad');
            $table->date('fecha_nacimiento')->comment('Fecha de nacimiento');
            $table->string('nacionalidad')->comment('Nacionalidad de la persona');
            $table->string('direccion')->nullable()->comment('Dirección de residencia');
            $table->string('ciudad')->nullable()->comment('Ciudad de residencia');
            $table->string('pais')->nullable()->comment('País de residencia');
            $table->string('telefono')->nullable()->comment('Número de teléfono de contacto');
            $table->string('email')->nullable()->comment('Correo electrónico de contacto');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
