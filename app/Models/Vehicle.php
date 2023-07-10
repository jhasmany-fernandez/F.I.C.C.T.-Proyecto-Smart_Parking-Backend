<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $table = 'vehicles';
    protected $fillable = ['id', 'placa', 'marca', 'color', 'tipo', 'user_id'];
    public $timestamps = false;


    //relacion con user de muchos a uno
    public function user(){
        return $this->belongsTo(User::class,'user_id','id' );
    }

    //realcion de bitacora de uno a muchos 
     public function bitacora(){
        return $this->hasMany(Bitacora::class,'vehicle_id');
     }

    //relacion con espacio  de muchos a muchos
    public function epacio(){
        return $this->belongsToMany(Espacio::class, 'vehicle_id', 'espacio_id')
        ->as('reserva')
        ->withPivot('id','espacio_id','vehicle_id');

    }
    
}
