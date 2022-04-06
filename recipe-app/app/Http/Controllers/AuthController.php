<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{


    public function register(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'username' => 'required|string|max:20|unique:users,username',
                'email' => 'required|string|unique:users,email|email',
                'password' => 'required||string|confirmed'
            ],
            [
                'username.unique' => 'A user with this username already exists',
                'email.unique' => 'This email is already being used',
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['message' => $errors], 422);
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return response()->json(['message' => 'User created', $user], 201);
    }

    public function login(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'username' => 'required|string|exists:users',
                'password' => 'required|string'
            ],
            [
                'exists' => 'Username does not exist',
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['message' => $errors], 401);
        }


        $user = User::where('username', $request->username)->first();

        //Check if password is correct
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Incorrect password'], 401);
        }

        //Create token
        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token], 200);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json(['message' => 'Logged out'], 200);
    }
}
