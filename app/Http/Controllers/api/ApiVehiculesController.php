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
    public function store(Request $request)
    {
        // Validar los datos recibidos
       
        $request->validate([
            'placa' => 'required',
            'marca' => 'required',
            'color' => 'required',
            'tipo' => 'required',
            'user_id' => 'required',
            // Agrega aquí las validaciones para cada campo que esperas recibir
        ]);

        // Crear un nuevo vehículo y asignar los valores recibidos
        $vehiculo = new Vehicle();
        $vehiculo->placa = $request->input('placa');
        $vehiculo->marca = $request->input('marca');
        $vehiculo->color = $request->input('color');
        $vehiculo->tipo = $request->input('tipo');
        $vehiculo->user_id = $request->input('user_id');      

        // Asigna aquí los valores para cada campo que esperas recibir

        // Guardar el vehículo en la base de datos
        $vehiculo->save();

        // Devolver una respuesta exitosa
        return response()->json([
            'message' => 'Vehículo guardado exitosamente',
            'vehiculo' => $vehiculo
        ], 200);
    }
    
    public function destroy($id)
{
    $vehiculo = Vehicle::findOrFail($id);
    $vehiculo->delete();

    return response()->json([
        'message' => 'Vehículo eliminado exitosamente',
    ], 200);
}


    
}
