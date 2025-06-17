<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('reservas_viaje', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('viaje_id');
            $table->integer('cantidad');
            $table->json('pasajeros');
            $table->decimal('precio_total', 10, 2);
            $table->string('estado')->default('pendiente');
            $table->string('metodo_pago')->nullable();
            $table->boolean('pagado')->default(false);
            $table->timestamp('fecha_pago')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('viaje_id')->references('id')->on('viajes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservas_viaje');
    }
};
