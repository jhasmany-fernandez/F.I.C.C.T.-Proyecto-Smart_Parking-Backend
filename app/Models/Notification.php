<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    protected $fillable = ['id','descripcion', 'user_id'];
    public $timestamps = false;

    //relacion con usuario de muchos a uno
    public function user(){
        return $this->belongsTo(User::class,'user_id','id' );
    }

}
