<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::all();
        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        // Query pencarian
        $anggota = Anggota::where('id_anggota', 'like', "%$keyword%")
            ->orWhere('nama_anggota', 'like', "%$keyword%")
            ->orWhere('jk_kelamin', 'like', "%$keyword%")
            ->orWhere('alamat_anggota', 'like', "%$keyword%")
            ->orWhere('no_telp', 'like', "%$keyword%")
            ->orWhere('status_anggota', 'like', "%$keyword%")
            ->get();

        // Kembalikan hasil ke view
        return view('anggota.index', compact('anggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'id_anggota' => 'required|unique:tb_anggota,id_anggota',
            'nama_anggota' => 'required|string|max:100',
            'jk_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'alamat_anggota' => 'nullable|string|max:100',
            'no_telp' => 'nullable|string|max:15',
            'status_anggota' => 'required|in:siswa,karyawan',
        ]);

        $last = Anggota::count();
        $idAnggota = 'AGT' . str_pad($last + 1, 3, '0', STR_PAD_LEFT);

        Anggota::create([
            'id_anggota' => $idAnggota,
            'nama_anggota' => $request->nama_anggota,
            'jk_kelamin' => $request->jk_kelamin,
            'alamat_anggota' => $request->alamat_anggota,
            'no_telp' => $request->no_telp,
            'status_anggota' => $request->status_anggota,
        ]);

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_anggota' => 'required|string|max:255',
            'jk_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'alamat_anggota' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'status_anggota' => 'required|in:siswa,karyawan',
        ]);

        Anggota::where('id_anggota', $id)->update($validated);

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Anggota::destroy($id);
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus.');
    }
}