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
        // Eliminada la creación de la tabla empleados
            $table->id();
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade')
                ->comment('ID del usuario asociado al empleado');
            $table->string('puesto')->comment('Cargo o puesto del empleado');
            $table->enum('nivel', [0, 1])->comment('Nivel jerárquico: 0 (básico), 1 (jefe)');
            $table->date('fecha_contratacion')->comment('Fecha en que se contrató al empleado');
            $table->string('salario')->comment('Salario base del empleado');
            $table->enum('estado', ['activo', 'inactivo', 'vacaciones', 'licencia'])->default('activo')
                ->comment('Estado actual del empleado');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
