<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function registerpost(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tb_petugas,email',
            'password' => 'required|string|min:8',
        ]);

        $last = User::count();

        $newIdPetugas = 'PTG' . str_pad($last + 1, 3, '0', STR_PAD_LEFT);

        $user = User::create([
            'id_petugas' => $newIdPetugas,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (!$user) {
            return back()->with('error', 'Gagal mendaftar');
        }

        return redirect('/login')->with('success', 'Register Sukses, silahkan login.');
    }

    public function login()
    {
        return view('login');
    }

    public function loginpost(Request $request)
    {
        // Validate login request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect('/home')->with('success', 'Login Sukses');
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
