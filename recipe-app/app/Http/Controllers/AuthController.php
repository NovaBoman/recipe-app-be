<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'username' => 'required|string|max:20|unique:users,username',
                'email' => 'required|string|unique:users,email',
                'password' => 'required||string|'
            ],
            [
                'username.unique' => 'A user with this username already exists',
                'email.unique' => 'This email is already being used'
            ]
        );

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        return User::create($request->all());
    }
}
