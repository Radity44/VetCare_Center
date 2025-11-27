<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    // Cek user dan role
    $user = User::where('email', $credentials['email'])->first();
    if (!$user) {
        return back()->withErrors(['email' => 'Email tidak ditemukan.']);
    }

    // if ($user->role !== 'admin') {
    //     return back()->withErrors(['email' => 'Anda bukan admin.']);
    // }

    // Login pakai Auth
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }

    return back()->withErrors(['password' => 'Password salah.']);
}

}
