<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    const PENDIENTE=1;  //reservado
    const TRANSCURSO=2; // el vehiculo a esta en el parqueo 
    const TERMINADO=3;   //la reserva acabo 
    
    protected $table = 'reservas';
    protected $fillable = [
        'id',
        'fecha_hora_ingreso_reserva',
        'fecha_hora_salida',
        'fecha_hora_salida_reserva',      
        'status',
        'qrentrada',
        'qrsalida',
        'vehicle_id',
        'espacio_id',
        'tarifa_id'
    ];
    public $timestamps = false;

    //relacion con pago de uno a muchos
    public function pago()
    {
        return $this->hasMany(Pago::class, 'reserva_id');
    }
    //relacion con tarifa de muchos a uno 
    public function tarifa()
    {
        return $this->belongsTo(Tarifa::class, 'tarifa_id', 'id');
    }
}
