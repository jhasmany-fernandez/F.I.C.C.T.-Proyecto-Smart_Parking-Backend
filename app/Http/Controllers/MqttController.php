<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Salman\Mqtt\MqttClass\Mqtt;
use Salman\Mqtt\MqttClass\MqttClient;


class MqttController extends Controller
{
    //
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
