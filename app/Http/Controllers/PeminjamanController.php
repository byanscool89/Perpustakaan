<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;


class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::all();
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $anggota = Anggota::all();
        $buku = Buku::all();

        return view('peminjaman.create', compact('anggota', 'buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_anggota' => 'required',
            // 'id_petugas' => 'required',
            'id_buku' => 'required',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'nullable|date|after_or_equal:tgl_pinjam',
        ]);

        $last = Peminjaman::count();
        $idPeminjaman = 'PJM' . str_pad($last + 1, 3, '0', STR_PAD_LEFT);

        Peminjaman::create([
            'id_peminjaman' => $idPeminjaman,
            'id_anggota' => $request->id_anggota,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali,
            'id_petugas' => Auth::user()->id_petugas,
            'id_buku' => $request->id_buku,
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil disimpan');
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return view('peminjaman.show', compact('peminjaman'));
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return view('peminjaman.edit', compact('peminjaman'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'nullable|date|after_or_equal:tgl_pinjam',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update($request->all());

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diubah');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus');
    }
}
