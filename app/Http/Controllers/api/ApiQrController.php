<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Salman\Mqtt\MqttClass\Mqtt;

class ApiQrController extends Controller
{
    public function validateQr(Request $request)
    {
        $qr = $request->qr;
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
            $this->publishMessage('on');
            return response()->json(['message' => 'Notificación enviada correctamente']);
        } else {
            return response()->json(['message' => 'Error al enviar la notificación'], 500);
        }
        return $qr;
    }
    public function publishMessage($parametro){
        $mqtt = new Mqtt();
        $topic = "servo_motor/comands";
        $output = $mqtt->ConnectAndPublish($topic, $parametro,'yordice77@gmail.com');
        if($output === true){
            return response()->json(['message' => 'Message Published'], 200);
        }else{
            return response()->json(['message' => 'Message Not Published'], 400);
        }
    }
}
