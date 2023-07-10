<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Pago;
use Illuminate\Http\Request;

class ApiPagoController extends Controller
{
    public function getpago(){
        return Pago::all();

    }
    public function getpagoReserva($id){
        return Pago::where('reserva_id', '=', $id)->get();
    }
}
