<?php

use App\Http\Controllers\api\ApiAuthController;
use App\Http\Controllers\api\ApiBitacoraController;
use App\Http\Controllers\api\ApiNotificaionController;
use App\Http\Controllers\api\ApiPagoController;
use App\Http\Controllers\api\ApiReporteController;
use App\Http\Controllers\api\ApiReservaController;
use App\Http\Controllers\api\ApiVehiculesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

/* ------------------------------------------------Usuarios-------------------------------------------------------- */
Route::post('/register', [ApiAuthController::class, 'register'])->name('api.register');
Route::post('/login', [ApiAuthController::class, 'login'])->name('api.login');
Route::get('/usuarios', [ApiAuthController::class, 'usuarios'])->name('api.usuarios');

//RUTAS PROTEGIDAS
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::get('/user', [ApiAuthController::class, 'user'])->name('api.user');
    Route::put('/user', [ApiAuthController::class, 'update'])->name('api.updateUser');
    Route::post('/logout',[ApiAuthController::class, 'logout'])->name('api.logout');
});


/* ------------------------------------------------Vehiculos-------------------------------------------------------- */
Route::get('/vehicules', [ApiVehiculesController::class, 'getvehicules'])->name('api.vehicules');
Route::get('/vehicules/{usuario}', [ApiVehiculesController::class, 'getvehiculesUsuario'])->name('api.vehiculesUser');
Route::post('/guardarvehiculo', [ApiVehiculesController::class, 'store'])->name('api.guardarVehiculo');
Route::delete('/eliminarvehiculo/{vehicule}',[ApiVehiculesController::class,'destroy'])->name('api.eliminarVehiculo');

/* ------------------------------------------------Notificaciones-------------------------------------------------------- */
Route::get('/notificacion', [ApiNotificaionController::class, 'getnotificaion'])->name('api.notificacion');
Route::get('/notificacion/{usuario}', [ApiNotificaionController::class, 'getnotificaionUsuario'])->name('api.notificacionUsuario');

/* ------------------------------------------------Bitacora-------------------------------------------------------- */
Route::get('/bitacora', [ApiBitacoraController::class, 'getbitacora'])->name('api.bitacora');
Route::get('/bitacora/{vehiculo}', [ApiBitacoraController::class, 'getbitacoraVehiculo'])->name('api.bitacotaVehiculo');


/* ------------------------------------------------Reporte-------------------------------------------------------- */
Route::get('/reporte', [ApiReporteController::class, 'getreporte'])->name('api.reporte');
Route::get('/reporte/{vehiculo}', [ApiReporteController::class, 'getreporteVehiculo'])->name('api.reporteVehiculo');

/* ------------------------------------------------Reserva-------------------------------------------------------- */
Route::get('/reserva', [ApiReservaController::class, 'getreserva'])->name('api.reserva');
Route::get('/reserva/{vehiculo}', [ApiReservaController::class, 'getreservaVehiculo'])->name('api.reservaVehiculo');
/* ------------------------------------------------Pago-------------------------------------------------------- */
Route::get('/pago', [ApiPagoController::class, 'getpago'])->name('api.pago');
Route::get('/pago/{reserva}', [ApiPagoController::class, 'getpagoReserva'])->name('api.pagoReserva');