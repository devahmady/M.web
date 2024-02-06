<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class Auth
{
    public static function index(Request $request)
    {
        if ($request->session()->has('user')) {
            return redirect('dashboard');
        }

        return view('login.login');
    }

    public static function login(Request $request)
    {
        $request->validate([
            'ip' => 'required',
            'user' => 'required'
        ]);

        $ip = $request->post('ip');
        $user = $request->post('user');
        $password = $request->post('password');

        $data = [
            'ip' => $ip,
            'user' => $user,
            'password' => $password,
        ];

        $request->session()->put($data);

        return redirect('dashboard');
    }

    public static function logout(Request $request)
    {
        $request->session()->forget('ip');
        $request->session()->forget('user');
        $request->session()->forget('password');

        return view('login.login');
    }
}
