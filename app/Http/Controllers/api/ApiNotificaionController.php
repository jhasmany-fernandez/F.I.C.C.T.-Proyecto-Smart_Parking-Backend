<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class ApiNotificaionController extends Controller
{
    public function getnotificaion(){
        return Notification::all();
    }

    public function getnotificaionUsuario($id){
       
        return Notification::where('user_id', '=', $id)->get();
    }
}
