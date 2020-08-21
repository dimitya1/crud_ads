<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function login()
    {
        return view('auth.login');
    }

    public function check()
    {
        $credentials = [
            'email' => request()->get('email'),
            'password' => request()->get('password'),
        ];

        $remember = request()->get('remember') === 'on';

        if (!Auth::attempt($credentials, $remember)) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Invalid email or password!']);
        }
        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}

