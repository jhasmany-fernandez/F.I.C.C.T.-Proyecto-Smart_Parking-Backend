<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Espacio;
use App\Models\Reserva;
use Illuminate\Http\Request;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\Writer\ValidationException;




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
        $codigo = '12345';
        $url = $this->generateQr($codigo);
        $reserva->qr = $url;
        $reserva->save();



        $request->validate([
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'personal_id' => 'required',
        ]);
     
        

        return response()->json([
            'qr' => $url,
            'message' => 'Reserva creada correctamente',
        ], 200);
    }


    public function testqr(Request $request)
    {
        $codigo = '12345';
        $url = $this->generateQr($codigo);

        return response()->json([
            'qr' => $url,
            'message' => 'Reserva creada correctamente',
        ], 200);
    }

    public function generateQr($content)
    {
        //Libreria: https://github.com/endroid/qr-code

        $qrCode = QrCode::create($content)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(250)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        $file = $result->getString();
        $folder = 'qr/';

        $fileName = uniqid();
        $extension = '.png';
        $url = $this->file_to_storage($file, $folder, $fileName, $extension);
        return $url;
    }
    public function file_to_storage($file, $folder, $fileName, $extension  = null)
    {
        try {
            $path = $folder . $fileName . $extension;
            Storage::disk('public')->put($path, $file);
            $url = "/storage/" . $path;
            return $url;
        } catch (\Throwable $th) {
            return "";
        }
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
