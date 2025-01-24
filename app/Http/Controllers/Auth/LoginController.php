<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        $brandLogo = DB::table('settings')->where('name', 'brand_logo')->value('payload');
        $brandLogo = trim($brandLogo, '"');
        return view('auth.login',  compact('brandLogo'));
    }

    // Tangani login pengguna
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt login
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect()->route('home'); // Redirect setelah login berhasil
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Tangani logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
