<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman register
    public function register()
    {
        return view('register');
    }

    // Proses data dari form register
    public function registerpost(Request $request)
    {
        // Validasi inputan dari form register
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tb_petugas,email', // Email harus unik di tabel tb_petugas
            'password' => 'required|string|min:8', // Password minimal 8 karakter
        ]);

        // Menghitung total user saat ini
        $last = User::count();

        // Membuat ID petugas baru dengan format PTG001, PTG002, dst.
        $newIdPetugas = 'PTG' . str_pad($last + 1, 3, '0', STR_PAD_LEFT);

        // Menyimpan data user baru ke database
        $user = User::create([
            'id_petugas' => $newIdPetugas,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Mengenkripsi password
        ]);

        // Jika gagal menyimpan, kembali ke form register
        if (!$user) {
            return back()->with('error', 'Gagal mendaftar');
        }

        // Jika berhasil, arahkan ke halaman login
        return redirect('/login')->with('success', 'Register Sukses, silahkan login.');
    }

    // Menampilkan halaman login
    public function login()
    {
        return view('login');
    }

    // Proses data dari form login
    public function loginpost(Request $request)
    {
        // Validasi input login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Ambil data login dari request
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Coba login dengan data tersebut
        if (Auth::attempt($credentials)) {
            return redirect('/home')->with('success', 'Login Sukses');
        }

        // Jika gagal login, kembali ke login dengan pesan error
        return back()->with('error', 'Email atau password salah');
    }

    // Logout user dan redirect ke login
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
