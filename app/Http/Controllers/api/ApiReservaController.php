<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Espacio;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;


class ApiReservaController extends Controller
{
    public function getreserva()
    {
        return Reserva::all();
    }
    // function getreservatiempo()
    // {
    //     $espacioId = 1;
    //     $fechaInicio = Carbon::createFromFormat('Y-m-d H:i:s', '2023-06-01 04:30:00');
    //     $fechaFin = Carbon::createFromFormat('Y-m-d H:i:s', '2023-06-01 08:59:00');

    //     return Reserva::where('espacio_id', $espacioId)
    //         ->where(function ($query) use ($fechaInicio, $fechaFin) {
    //             $query->where(function ($query) use ($fechaInicio, $fechaFin) {
    //                 $query->where('fecha_hora_ingreso_reserva', '>=', $fechaInicio)
    //                     ->where('fecha_hora_ingreso_reserva', '<=', $fechaFin);
    //             })
    //             ->orWhere(function ($query) use ($fechaInicio, $fechaFin) {
    //                 $query->where('fecha_hora_salida_reserva', '>', $fechaInicio)
    //                     ->where('fecha_hora_salida_reserva', '<=', $fechaFin);
    //             })
    //             ->orWhere(function ($query) use ($fechaInicio, $fechaFin) {
    //                 $query->where('fecha_hora_ingreso_reserva', '<', $fechaInicio)
    //                     ->where('fecha_hora_salida_reserva', '>', $fechaFin);
    //             });
    //         })
    //         ->get();
    // }



    public function obtenerEspacios(Request $request)
    {
        $horaInicio = $request->input('hora_inicio');
        $horaFin = $request->input('hora_fin');

        $espaciosEstado = $this->obtenerEspaciosOcupadosLibres($horaInicio, $horaFin);

        return response()->json($espaciosEstado);
    }


    public function obtenerEspaciosOcupadosLibres($horaInicio, $horaFin)
    {
        $espacios = Espacio::all();
        $espaciosEstado = [];

        foreach ($espacios as $espacio) {
            $reservas = Reserva::where('espacio_id', $espacio->id)
                ->where(function ($query) use ($horaInicio, $horaFin) {
                    $query->where(function ($query) use ($horaInicio, $horaFin) {
                        $query->where('fecha_hora_ingreso_reserva', '>=', $horaInicio)
                            ->where('fecha_hora_ingreso_reserva', '<=', $horaFin);
                    })
                        ->orWhere(function ($query) use ($horaInicio, $horaFin) {
                            $query->where('fecha_hora_salida_reserva', '>', $horaInicio)
                                ->where('fecha_hora_salida_reserva', '<=', $horaFin);
                        })
                        ->orWhere(function ($query) use ($horaInicio, $horaFin) {
                            $query->where('fecha_hora_ingreso_reserva', '<', $horaInicio)
                                ->where('fecha_hora_salida_reserva', '>', $horaFin);
                        });
                })
                ->get();

            if ($reservas->isNotEmpty()) {
                // El espacio está ocupado en el rango de tiempo especificado
                $espaciosEstado[] = [
                    'id' => $espacio->id,
                    'numero' => $espacio->numero,
                    'estado' => 0, // Ocupado
                    'created_at' => $espacio->created_at,
                    'updated_at' => $espacio->updated_at,
                ];
            } else {
                // El espacio está libre en el rango de tiempo especificado
                $espaciosEstado[] = [
                    'id' => $espacio->id,
                    'numero' => $espacio->numero,
                    'estado' => 1, // Libre
                    'created_at' => $espacio->created_at,
                    'updated_at' => $espacio->updated_at,
                ];
            }
        }

        return $espaciosEstado;
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

    public function getqr()
    {
        // $pythonScript = "helpers/recognizing-colors-ia.py";
        $pythonScript = "E:/Xampp 2.0/htdocs/F.I.C.C.T.-Proyecto-Smart_Parking-Backend/public/helpers/IA-generar_Qr/GenQR.py";
        $process = new Process(['python', $pythonScript]);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output = $process->getIncrementalOutput();
        while (!$process->isTerminated()) {
            $output .= $process->getIncrementalOutput();
        }
        $result = $output;

        return response()->json(['result' => $result]);
    }
}
