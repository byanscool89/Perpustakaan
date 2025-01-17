<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;


class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil keyword dari input pencarian
        $keyword = $request->input('keyword'); 
    
        // Query peminjaman dengan join ke tb_anggota dan tb_buku
        $peminjaman = Peminjaman::join('tb_anggota', 'tb_anggota.id_anggota', '=', 'tb_peminjaman.id_anggota')
            ->join('tb_buku', 'tb_buku.id_buku', '=', 'tb_peminjaman.id_buku')
            ->select('tb_peminjaman.*', 'tb_buku.judul', 'tb_anggota.nama_anggota')
            ->where('status', 'dipinjam') // Filter berdasarkan status dipinjam
            ->when($keyword, function ($query, $keyword) {
                $query->where('tb_anggota.nama_anggota', 'like', "%$keyword%")
                      ->orWhere('tb_buku.judul', 'like', "%$keyword%")
                      ->orWhere('tb_peminjaman.id_peminjaman', 'like', "%$keyword%");
            })
            ->get();
    
        // Return data ke view
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
            'status' => 'dipinjam',
            'id_buku' => $request->id_buku,
        ]);

        Buku::where('id_buku',$request->id_buku)->decrement('stok',1);
        

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
