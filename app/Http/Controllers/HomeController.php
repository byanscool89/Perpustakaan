<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $jumlahAnggota = Anggota::count();
        $jumlahPeminjaman = Peminjaman::count();
        $jumlahPengembalian = Pengembalian::count(); // Variabel ini dihitung tetapi tidak dipakai di compact()
    
        return view('home', compact('jumlahAnggota', 'jumlahPeminjaman', 'jumlahPengembalian'));
    }
    
}
