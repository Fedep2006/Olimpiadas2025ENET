<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('pagos', function (Blueprint $table) {
            $table->unsignedBigInteger('reserva_viaje_id')->nullable()->after('reserva_id');
            $table->foreign('reserva_viaje_id')->references('id')->on('reservas_viaje')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('pagos', function (Blueprint $table) {
            $table->dropForeign(['reserva_viaje_id']);
            $table->dropColumn('reserva_viaje_id');
        });
    }
};
