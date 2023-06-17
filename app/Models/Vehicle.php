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

}
