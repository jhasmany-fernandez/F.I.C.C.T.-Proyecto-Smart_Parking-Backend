<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Espacio extends Model
{
    use HasFactory;
    protected $table = 'espacios';
    protected $fillable = ['id', 'numero', 'estado'];
    public $timestamps = false;

    //relacion de muchos a muchos con vehiculo
    public function vehiculos(){
        return $this->belongsToMany(Vehicle::class,  'espacio_id','vehicle_id')
        ->as('reserva')
        ->withPivot('id','vehicle_id','espacio_id');
    }

}
