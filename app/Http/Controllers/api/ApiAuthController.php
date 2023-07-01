<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
    public function register(Request $request){

        $attr = $request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|confirmed'
        ]);
        
        //create user
        $user = User::create([
            'name'=>$attr['name'],
            'email'=>$attr['email'],
            'password'=>bcrypt($attr['name']),

        ]);

        return response([
            'user'=>$user,
            'token'=> $user->createToken('secret')->plainTextToken
        ]);
    }

    public function login(Request $request){
        
        $attr = $request->validate([
           
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);

        if(!Auth::attempt($attr)){
            return response(
                [
                    'message'=> 'Invalid credentials'
                ], 403
            );
        }

        return response([
            'user'=>auth()->user(),
            'token'=> auth()->user->createToken('secret')->plainTextToken
        ],200);
    }

    public function logout(){
        auth()->user->tokens()->delete();
        return response([
            'message'=>'Logout sucessus'
        ],200);
    }
    public function user(){
        return response([
            'user'=>auth()->user()
        ],200);
    }
    public function usuarios(){
        return User::all();
    }
}
