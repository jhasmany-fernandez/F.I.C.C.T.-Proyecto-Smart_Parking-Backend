<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IASController extends Controller
{
    public function index(){
        return view('my_views.show_ia');
    }
}
