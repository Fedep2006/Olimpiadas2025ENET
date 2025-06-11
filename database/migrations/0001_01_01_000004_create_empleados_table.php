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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade')
                ->comment('ID del usuario asociado al empleado');
            $table->foreignId('persona_id')->constrained('personas')->onDelete('cascade')
                ->comment('ID de la persona asociada al empleado');
            $table->string('puesto')->comment('Cargo o puesto del empleado');
            $table->enum('nivel', [0, 1, 2, 3])->comment('Nivel jerárquico: 0 (básico), 1 (intermedio), 2 (supervisor), 3 (gerencial)');
            $table->date('fecha_contratacion')->comment('Fecha en que se contrató al empleado');
            $table->decimal('salario', 10, 2)->comment('Salario base del empleado');
            $table->enum('estado', ['activo', 'inactivo', 'vacaciones', 'licencia'])->default('activo')
                ->comment('Estado actual del empleado');
            $table->json('habilidades')->nullable()->comment('Array de habilidades o competencias del empleado');
            $table->json('certificaciones')->nullable()->comment('Array de certificaciones o títulos del empleado');
            $table->text('observaciones')->nullable()->comment('Notas adicionales sobre el empleado');
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
