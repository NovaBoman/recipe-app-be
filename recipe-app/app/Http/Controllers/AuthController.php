<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
            return $validator->errors()->all();
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return ['user' => $user];
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        //Check if user exists
        $user = User::where('username', $request->username)->first();
        if (!$user) {
            return ["message" => "Username does not exist"];
        }

        //Check if password is correct
        if (!Hash::check($request->password, $user->password)) {
            return ["message" => "Incorrect password"];
        }

        //Create token
        $token = $user->createToken('api_token')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return ['message' => 'logged out ' . Auth::user()->username];
    }
}
