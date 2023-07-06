<?php

use App\Models\Reserva;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_hora_ingreso_reserva');
            $table->dateTime('fecha_hora_salida');
            $table->dateTime('fecha_hora_salida_reserva');
            $table->string('estado');
            $table->enum('status',[Reserva::PENDIENTE,Reserva::TRANSCURSO,Reserva::TERMINADO,])->default(Reserva::PENDIENTE);
            $table->string('qrentrada');
            $table->string('qrsalida');
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('espacio_id')->nullable();
            $table->foreign('espacio_id')->references('id')->on('espacios')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('tarifa_id')->nullable();
            $table->foreign('tarifa_id')->references('id')->on('tarifas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
