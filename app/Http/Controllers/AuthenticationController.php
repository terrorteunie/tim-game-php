<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        $name = $request->get('name');
        $existingUser = User::where('name', $name)->first();
        if ($existingUser) {
            return ['error' => 'name already exists'];
        }

        $password = Hash::make($request->get('password'));

        $user = new User([
            'name' => $name,
            'password' => $password
        ]);
        $user->save();
        $token = $user->createToken('login');
        return ['token' => $token->plainTextToken];
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken('login');
            return ['token' => $token->plainTextToken];
        }
 
        return ['error' => 'invalid login'];
    }
}
