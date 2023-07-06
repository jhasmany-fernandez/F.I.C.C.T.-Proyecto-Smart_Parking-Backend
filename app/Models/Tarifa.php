<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
    use HasFactory;
    protected $table = 'tarifas';
    protected $fillable = ['id', 'tiempo', 'monto'];
    public $timestamps = false;
   
    //relacion de tarifa con reserva de uno a muchos 

    public function reserva(){
        return $this->hasMany(Reserva::class,'tarifa_id');
    }
}
