<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $table = 'pagos';
    protected $fillable = ['id','tiempo_reserva', 'monto', 'reserva_id'];
    public $timestamps = false;

}
