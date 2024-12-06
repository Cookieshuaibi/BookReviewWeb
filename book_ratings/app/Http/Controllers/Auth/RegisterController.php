<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role as RoleModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name' => 'required|string|min:3|max:50',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|max:50|confirmed',
            ]);
            if ($validated) {
                $user_role_id = RoleModel::where('name', 'user')->first();
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                $user->roles()->attach($user_role_id);
                Auth::login($user);
                return redirect()->route('home');
            } else {
                return redirect()->back()->withInput();
            }
        }
        return view('auth.register');
    }
}
