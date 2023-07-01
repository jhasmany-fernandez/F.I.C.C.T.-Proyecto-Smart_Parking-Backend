<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use Illuminate\Http\Request;

class ApiReservaController extends Controller
{
    public function getreserva(){
        return Reserva::all();
    }
    public function getreservaVehiculo($id){
        return Reserva::where('vehicle_id', '=', $id)->get();
    }
}
