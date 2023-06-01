<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;
    protected $table = 'bitacoras';
    protected $fillable = ['id','fecha_hora_ingreso', 'fecha_hora_salida','vehicle_id'];
    public $timestamps = false;

}
