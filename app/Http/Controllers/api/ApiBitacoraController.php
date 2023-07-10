<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Bitacora;
use Illuminate\Http\Request;

class ApiBitacoraController extends Controller
{
    public function getbitacora(){
        return Bitacora::all();
    }
    public function getbitacoraVehiculo($id){
        return Bitacora::where('vehicle_id', '=', $id)->get();
    }
}
