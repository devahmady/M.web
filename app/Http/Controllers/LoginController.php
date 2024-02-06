<?php

namespace App\Http\Controllers;

use App\Models\MikrotikApi;
use Illuminate\Http\Request;
use App\Helpers\Auth;
class LoginController extends Controller
{
    public function index(Request $request)
    {
        return Auth::index($request);
    }

    public function login(Request $request)
    {
        return Auth::login($request);
    }

    public function logout(Request $request)
    {
        return Auth::logout($request);
    }
}
error_reporting(0);
