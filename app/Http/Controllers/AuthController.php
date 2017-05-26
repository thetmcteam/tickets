<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function check(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials, false)) {
            return redirect()->route('tickets');
        }

        return redirect()->route('login');
    }
}
