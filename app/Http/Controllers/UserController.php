<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function users(){
        $users = User::with('roles')->paginate(10);
        return response()->json($users);
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

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['message' => 'Successfully deleted an account']);
    }
}
