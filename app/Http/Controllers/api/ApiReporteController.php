<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Reporte;
use Illuminate\Http\Request;

class ApiReporteController extends Controller
{
   public function getreporte(){
    return Reporte::all();
   }
   public function getreporteVehiculo($id){
    return Reporte::where('vehicle_id', '=', $id)->get();
   }
}
