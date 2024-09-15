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
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Retrieve the last registered user with id_petugas starting with 'PTG'
        $lastUser = User::where('id_petugas', 'LIKE', 'PTG%')
                        ->orderBy('id_petugas', 'desc')
                        ->first();

        // Generate a new id_petugas
        if ($lastUser) {
            $lastIdNumber = (int) substr($lastUser->id_petugas, 3);
            $newIdNumber = $lastIdNumber + 1;
            $newIdPetugas = 'PTG' . str_pad($newIdNumber, 3, '0', STR_PAD_LEFT);
        } else {
            $newIdPetugas = 'PTG001';
        }

        // Create new user
        $user = new User();
        $user->id_petugas = $newIdPetugas;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        // Save user
        $user->save();

        // Redirect to login page with success message
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
