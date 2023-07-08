<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use Illuminate\Http\Request;

class ApiReservaController extends Controller
{
    public function getreserva()
    {
        return Reserva::all();
    }
    public function getreservaVehiculo($id)
    {
        return Reserva::where('vehicle_id', '=', $id)->get();
    }

    public function store(Request $request)
    {
        $reserva = new Reserva;
        $reserva->fecha_hora_ingreso_reserva = $request->input('fecha_hora_ingreso_reserva');
        $reserva->fecha_hora_salida = $request->input('fecha_hora_salida');
        $reserva->fecha_hora_salida_reserva = $request->input('fecha_hora_salida_reserva');
        // $reserva->status = $request->input('status');
        // $reserva->qrentrada = $request->input('qrentrada');
        // $reserva->qrsalida = $request->input('qrsalida');
        $reserva->vehicle_id = $request->input('vehicle_id');
        $reserva->espacio_id = $request->input('espacio_id');
        $reserva->tarifa_id = $request->input('tarifa_id');
        $reserva->save();

        return response()->json(['message' => 'Reserva creada correctamente'], 200);
    }
}
