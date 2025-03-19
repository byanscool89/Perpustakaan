<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use Illuminate\Http\Request;

class RakController extends Controller
{
    // Menampilkan semua data rak
    public function index()
    {
        $rak = Rak::all();
        return view('rak.index', compact('rak'));
    }

    // Menampilkan form untuk menambahkan rak baru
    public function create()
    {
        return view('rak.create');
    }

    // Menyimpan data rak baru ke database
    public function store(Request $request)
    {
        $request->validate([
            // 'id_rak' => 'required|string|max:15|unique:tb_rak,id_rak',
            'nama_rak' => 'nullable|string|max:50',
            'lokasi_rak' => 'nullable|string|max:50',
        ]);

        $lastRak = Rak::orderBy('id_rak', 'desc')->first();
        if ($lastRak) {
            $lastIdNumber = (int) substr($lastRak->id_rak, 3);
            $newIdNumber = $lastIdNumber + 1;
            $newIdrak = 'RAK' . str_pad($newIdNumber, 3, '0', STR_PAD_LEFT);
        } else {
            $newIdrak = 'RAK001';
        }

        Rak::create([
            'id_rak' => $newIdrak,
            'nama_rak' => $request->nama_rak,
            'lokasi_rak' => $request->lokasi_rak
        ]);

        return redirect()->route('rak.index')->with('success', 'Rak berhasil ditambahkan.');
    }

    // Menampilkan detail data rak berdasarkan ID
    public function show($id)
    {
        $rak = Rak::findOrFail($id);
        return view('rak.show', compact('rak'));
    }

    // Menampilkan form untuk mengedit data rak
    public function edit($id)
    {
        $rak = Rak::findOrFail($id);
        return view('rak.edit', compact('rak'));
    }

    // Mengupdate data rak yang ada
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_rak' => 'nullable|string|max:50',
            'lokasi_rak' => 'nullable|string|max:50',
        ]);

        $rak = Rak::findOrFail($id);
        $rak->update($request->all());
        return redirect()->route('rak.index')->with('success', 'Rak berhasil diupdate.');
    }

    // Menghapus data rak
    public function destroy($id)
    {
        $rak = Rak::findOrFail($id);
        $rak->delete();
        return redirect()->route('rak.index')->with('success', 'Rak berhasil dihapus.');
    }
}