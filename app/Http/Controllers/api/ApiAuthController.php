<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function register(Request $request)
    {

        $attr = $request->validate([
            'name' => 'required|string',
            'ci' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        //create user
        $user = User::create([
            'name' => $attr['name'],
            'ci' => $attr['ci'],
            'email' => $attr['email'],
            'password' => bcrypt($attr['password']),

        ]);

        $token = $user->createToken('secret')->plainTextToken;
        $user = $user->toArray();
        $user['token'] = $token;
       
        return response()->json([
            "status" => 1,
            "msg" => "Se ha registrado correctamente",
            "user" => $user,
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where("email", "=", $request->email)->first();

        if (isset($user->id)) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken("auth_token")->plainTextToken;
                $user = $user->toArray();
                $user['token'] = $token;
                return response()->json([
                    "status" => 1,
                    "msg" => "Inicio de sesion correctamente",
                    "user" => $user,
                ]);
            } else {
                return response()->json([
                    "status" => 0,
                    "msg" => "La contraseña es incorrecta",
                ], 404);
            }
        } else {
            return response()->json([
                "status" => 0,
                "msg" => "Usuario no registrado",
            ], 404);
        }
    }

    public function logout()
    {
        auth()->user->tokens()->delete();
        return response([
            'message' => 'Logout success'
        ], 200);
    }

    public function user()
    {
        return response([
            'user' => auth()->user()
        ], 200);
    }

    public function usuarios()
    {
        return User::all();
    }

    public function update(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|string',
            'ci' => 'required|string',
        ]);

        auth()->user->update([
            'name' => $attr['name'],
            'ci' => $attr['ci'],
        ]);

        return response([
            'message' => 'User updated',
            'user' => auth()->user()
        ], 200);
    }
}
