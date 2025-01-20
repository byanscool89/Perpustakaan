<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Denda;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalian = Pengembalian::all();
        return view('pengembalian.index', compact('pengembalian'));
    }

    public function create()
    {
        $peminjaman = Peminjaman::all();
        $denda = Denda::all();
        return view('pengembalian.create', compact('peminjaman','denda'));
    }

    public function store(Request $request)
    {
        $cek = $request->validate([
            'tgl_dikembalikan' => 'required|date',
            'id_peminjaman' => 'required',
            'id_denda' => 'required',
        ]);

        $getPeminjaman = Peminjaman::where('id_peminjaman',$request->id_peminjaman)->first();
        $id_buku = $getPeminjaman->id_buku;

        $last = Pengembalian::count();
        $idPengembalian = 'PBM' . str_pad($last + 1, 3, '0', STR_PAD_LEFT);

        Pengembalian::create([
            'id_petugas' => Auth::user()->id_petugas,
            'id_pengembalian' => $idPengembalian,
            'id_peminjaman' => $request->id_peminjaman,
            'tgl_dikembalikan' => $request->tgl_dikembalikan,
            'id_denda' => $request->id_denda,
            'id_buku' => $id_buku,
        ]);

        Peminjaman::where('id_peminjaman', $request->id_peminjaman)
        ->update([
            'status' => 'dikembalikan',
        ]);

        Buku::where('id_buku',$id_buku)->increment('stok', 1);

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil disimpan');
    }

    public function lapPengembalian(Request $request)
    {
        $keyword = $request->input('keyword');
        $pengembalian = Peminjaman::join('tb_anggota', 'tb_anggota.id_anggota', '=', 'tb_peminjaman.id_anggota')
        ->join('tb_buku', 'tb_buku.id_buku', '=', 'tb_peminjaman.id_buku')
        ->select('tb_peminjaman.*', 'tb_buku.judul', 'tb_anggota.nama_anggota')
        ->where('status', 'dikembalikan') // Filter berdasarkan status kembali
        ->when($keyword, function ($query, $keyword) {
            $query->where('tb_anggota.nama_anggota', 'like', "%$keyword%")
                  ->orWhere('tb_buku.judul', 'like', "%$keyword%")
                  ->orWhere('tb_peminjaman.id_peminjaman', 'like', "%$keyword%");
        })
        ->get();
        return view('laporan_pengembalian.index', compact('pengembalian'));
    }

}
