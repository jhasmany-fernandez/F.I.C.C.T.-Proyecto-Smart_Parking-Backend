<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    protected $table = 'reservas';
    protected $fillable = ['id', 'fecha_hora_ingreso', 'fecha_hora_salida', 'lugar_reserva', 'vehicle_id'];
    public $timestamps = false;
}
