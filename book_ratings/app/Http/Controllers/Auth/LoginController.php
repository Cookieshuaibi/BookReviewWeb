<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('home');
            }
            return back()->withErrors([
                'email' => 'Email or password is incorrect.',
            ]);
        }
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        // logout logic here
        Auth()->logout();
        return redirect()->route('login');
    }
}
