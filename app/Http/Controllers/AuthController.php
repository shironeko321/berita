<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // $credentials = $request->validate([
        //     'email' => ['required', 'email'],
        //     'password' => ['required']
        // ]);

        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();

        //     return redirect()->intended('dashboard');
        // }

        // return back()->withErrors([
        //     "error" => "email atau password salah"
        // ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        // Auth::logout();

        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        // return redirect("/login");
    }
}
