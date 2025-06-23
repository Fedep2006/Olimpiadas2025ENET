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
        Schema::table('reservas', function (Blueprint $table) {
            $table->unsignedBigInteger('paquete_id')->nullable()->change();
            $table->string('tipo_reserva')->after('estado'); // O ENUM si prefieres: ->enum('tipo_reserva', ['paquete', 'hospedaje', 'vehiculo'])
        });
    }

    /**
     * Reverse the migrations.
     */
        public function down(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            $table->unsignedBigInteger('paquete_id')->nullable(false)->change();
            $table->dropColumn('tipo_reserva');
        });
    }
};
