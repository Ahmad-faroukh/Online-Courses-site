<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($login)){
            $user = Auth::user();
            $token = $user->createToken('api auth token')->accessToken;
            return response()->json([
               'status' => 'success',
               'token' => $token,
            ]);
        }

        if ($validator->fails()) {
            return response()->json($validator->messages()->all()[0],406);
        }

        return response([
            'status' => 'error',
            'message' => 'auth failed'
        ]);

    }
}
