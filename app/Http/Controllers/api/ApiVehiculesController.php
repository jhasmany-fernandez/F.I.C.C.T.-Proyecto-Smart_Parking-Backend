<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ApiVehiculesController extends Controller
{
    public function getvehicules(){
        return Vehicle::all();
    }

    public function getvehiculesUsuario($id){
       
        return Vehicle::where('user_id', '=', $id)->get();
    }

}
