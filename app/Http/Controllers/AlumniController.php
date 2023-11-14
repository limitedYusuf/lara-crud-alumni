<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Alumni;

class AlumniController extends Controller
{
    use AuthenticatesUsers;

    public function showLoginForm()
    {
        return view('alumni.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $alumni = Alumni::where('email', $credentials['email'])->first();

        if (!$alumni) {
            return redirect()->route('alumni.login')->with('error', 'No account is registered with this email.');
        }

        if ($alumni->status === 'N') {
            return redirect()->route('alumni.login')->with('error', 'Account is inactive. Please contact admin for assistance.');
        }

        if (Auth::guard('alumni')->attempt($credentials)) {
            return redirect()->intended(route('alumni.dashboard'));
        }

        return redirect()->route('alumni.login')->with('error', 'Invalid login credentials');
    }


    public function showRegisterForm()
    {
        return view('alumni.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:alumnis',
            'password' => 'required|min:4|confirmed',
        ]);

        Alumni::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => 'N',
        ]);

        return redirect()->route('alumni.login')->with('success', 'Pembuatan akun berhasil, saat ini akun belum bisa digunakan. Tunggu admin untuk verifikasi akun');
    }

    public function logout()
    {
        Auth::guard('alumni')->logout();

        return redirect('/');
    }
}
