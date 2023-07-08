<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    const PENDIENTE=1; //SE HA GENERADO LA ORDEN PERO NO SE HA PAGADO (ESTA SE PONE POR DEFECTO)
    const TRANSCURSO=2; //SE HA GENERADO Y SE HA PAGADO A ORDEN
    const TERMINADO=3;
    
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
