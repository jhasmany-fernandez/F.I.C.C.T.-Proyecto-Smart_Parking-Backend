<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Tarifa;
use Illuminate\Http\Request;

class ApiTarifaController extends Controller
{
    public function gettarifas(){
        return Tarifa::all();
    }
}
