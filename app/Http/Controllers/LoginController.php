<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 422);
        }

        //get credentials from request
        $credentials = $request->only('email', 'password');
        JWTAuth::factory()->setTTL(120);

        //if auth failed
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau Password Anda salah'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'user'    => auth('api')->user(),
            'token'   => $token,
            'exp' => JWTAuth::factory()->getTTL() * 60,
        ], 200);
    }

    public function regis(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email'     => 'required',
            'password'  => 'required',
            'role'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 422);
        }

        $user = User::create([
            'name'     => $request->name,
            'email'     => $request->email,
            'password'   => Hash::make($request->password),
            'role'  => $request->role,
        ]);
        return response()->json(['message' => 'Successfully created an account']);
    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Successfully Logged Out']);
    }

}
