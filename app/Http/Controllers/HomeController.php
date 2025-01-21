<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $jumlahAnggota = Anggota::count();
        $jumlahPeminjaman = Peminjaman::count();
        $jumlahPengembalian = Pengembalian::count();
        $jumlahBuku = Buku::count();
    
        return view('home', compact('jumlahAnggota', 'jumlahPeminjaman', 'jumlahPengembalian','jumlahBuku'));
    }
    
}
