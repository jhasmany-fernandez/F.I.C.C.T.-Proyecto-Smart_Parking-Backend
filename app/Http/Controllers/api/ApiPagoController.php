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

    public function guardarPago(Request $request)
    {
        $pago = new Pago;
        $pago->monto = $request->input('monto');
        $pago->reserva_id = $request->input('reserva_id');
        // Aquí puedes agregar más campos del pago si es necesario
        $pago->save();

        return response()->json([
            'message' => 'Pago guardado correctamente',
        ], 200);
    }
    
}
