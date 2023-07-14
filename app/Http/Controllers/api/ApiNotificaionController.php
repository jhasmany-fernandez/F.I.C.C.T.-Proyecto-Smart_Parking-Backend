<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiNotificaionController extends Controller
{
    public function getnotificaion(){
        return Notification::all();
    }

    public function getnotificaionUsuario($id){
       
        return Notification::where('user_id', '=', $id)->get();
    }

    
    public function send_notification(Request $request)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $body = [
            'notification' => [
                'body' => 'Texto de la notificación!!!',
                'title' => 'Holaaa Notificaciones'
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



}
