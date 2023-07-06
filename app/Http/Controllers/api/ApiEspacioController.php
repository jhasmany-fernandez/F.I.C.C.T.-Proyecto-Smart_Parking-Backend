<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Espacio;
use Illuminate\Http\Request;

class ApiEspacioController extends Controller
{
    public function getespacios(){
        return Espacio::all();
    }
}
