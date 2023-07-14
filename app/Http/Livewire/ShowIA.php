<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

use Livewire\WithFileUploads;
use Salman\Mqtt\MqttClass\Mqtt;

class ShowIA extends Component
{

    use WithFileUploads;


    public $image_preview, $image;

    // public function save(Request $request)
    // {
    //     $path = "Sin datos";
    //     // $image = $request->file('file');
    //     //  $url = Storage::put('public/imgs/testing_images', $request->file('file'));
    //     // $image = Storage::put('\public\imgs\testing_images', $request->file('file'));
    //     // return view('my_views.testing_images.save_image', compact('image'));
    //     // $this->file = Input::file('fasdfas');
    //     // $file->move(public_path().'/images/',$user->id.'.jpg');
    //     // Storage::put('public/imgs/testing_images/' . $request->filePath, $this->filePath);
    //     if ($request->hasFile('file')) {
    //         $destination_path = 'public/imgs/testing_images';
    //         $image = $request->file('file');
    //         $image_name = $image->getClientOriginalName();
    //         $path = $request->file('file')->storeAs($destination_path, $image_name);
    //     }
    //     return $path;
    // }

    public function updatedImage()
    {
        $this->image_preview = $this->image->temporaryUrl(); // guardamos la url temporal de la imagen


    }

    public function readQR()
    {
        //$pythonScript = "helpers/IA-generar_Qr/GenQR.py";
        $pythonScript = "helpers/IA-leer_Qr/Lectura.py";
        // $pythonScript = "helpers/Lectura.py";
        //$user = auth()->id();

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

        if ($result !=  '') {


            // ABRIR Y CERRAR LA BARRA CON EL PROGRAMA DE ARDUINO
            $mqtt = new Mqtt();
            $topic = "servo_motor/comands";
            $output = $mqtt->ConnectAndPublish($topic, 'on', 'yordice77@gmail.com');
            if ($output === true) {
                $resp = response()->json(['message' => 'Message Published'], 200);
            } else {
                $resp = response()->json(['message' => 'Message Not Published'], 400);
            }

            // ENVIAR LA NOTIFICACIÓN DE CONFIRMACIÓN, A LA SALIDA Y ENTRADA
            $url = 'https://fcm.googleapis.com/fcm/send';
            $body = [
                'notification' => [
                    'body' => '¡Verificación realizada exitosamente!',
                    'title' => 'SmartParking le desea un buen día.'
                ],
                'to' => 'e7TtAb_tQVejao8XOwnqUL:APA91bEXLJKNIkHfFRepxx06EBuGObu7tlFbo0PSxrRTX2CtYrFeTnkbetvcSfUI7cQZZPq7NQsIfEdT8czEfYmsDj9Rb3tfJ0F4fKVBNTlpi9NLIzor4vi-k5OShTyCimQmyqf3tgff'
            ];
            $header = [
                'Authorization' => 'key=AAAA9TOXkd8:APA91bHncyaTpNAmanNpegOVaWGBNXCSIxjP0jp3J01iiY0qhfPSbQa_LGdxKmNK-TvO1yXGbcftakL9ZkcW0gamEO8xIFMPQie_ay5yZHItaJZZ60tEGFWbeCklOiTWJkVRFfqvT8fz'
            ];
    
            $response = Http::withHeaders($header)->post($url, $body);
    
            // Manejar la respuesta de la solicitud
            if ($response->successful()) {
                return response()->json(['message' => 'Notificación enviada correctamente']);
            } else {
                return response()->json(['message' => 'Error al enviar la notificación'], 500);
            }


          
        }


        // if ($this->image->hasFile('file')) {
        //     $destination_path = 'public/imgs';
        //     $image = $this->image->file('file');
        //     $image_name = $image->getClientOriginalName();
        //     $path = $$this->image->file('file')->storeAs($destination_path, $image_name);
        // }

        //dd('Leer QR');
    }

    public function generateQR()
    {
        // $pythonScript = "helpers/recognizing-colors-ia.py";
        $pythonScript = "helpers/IA-generar_Qr/GenQR.py";
        // $pythonScriptImage = "images/image4.png";
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
        // dd('enter');
        // dd('1234');

        //dd('Generar QR');
    }



    public function updateColor()
    {
        $pythonScript = "helpers/recognizing-colors-ia.py";
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

        dd($result);
        // dd("Hola Mundo");
        dd(true);
    }




    public function render()
    {
        return view('livewire.show-i-a');
    }
}
