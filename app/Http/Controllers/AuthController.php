<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function authenticate( Request $request)
    {
    $credetials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',

    ]);

    if (Auth::attempt($credetials)) {
        $request->session()->regenerate();
        
        return redirect()->intended('dashboard');

    }

    return back()->with('loginError', 'Login failed, Periksa Kembali Akun Anda.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

}