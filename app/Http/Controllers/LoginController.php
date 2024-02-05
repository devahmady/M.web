<?php

namespace App\Http\Controllers;

use App\Models\MikrotikApi;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('user')) {
            return redirect('dashboard');
        }
    
        return view('login.login');
    }

    public function login(Request $request)
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

    public function logout(Request $request)
    {
        $request->session()->forget('ip');
        $request->session()->forget('user');
        $request->session()->forget('password');

        return view('login.login');
    }
}
error_reporting(0);
