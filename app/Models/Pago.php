<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $table = 'pagos';
    protected $fillable = ['id', 'monto', 'reserva_id'];
    public $timestamps = false;

    //relacion con reserva de muchos a uno 
    public function reserva(){
        return $this->belongsTo(Reserva::class,'reserva_id','id');
    }

}

