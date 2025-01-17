<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    // Menampilkan semua data denda
    public function index()
    {
        $denda = Denda::all();
        return view('denda.index', compact('denda'));
    }

    // Menampilkan form untuk menambahkan denda baru
    public function create()
    {
        return view('denda.create');
    }

    // Menyimpan data denda baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'id_denda' => 'required|string|unique:tb_denda,id_denda',
            'kategori_denda' => 'required|string|max:255',
            'biaya' => 'required|numeric',
        ]);

        Denda::create($request->all());
        return redirect()->route('denda.index')->with('success', 'Denda berhasil ditambahkan.');
    }

    // Menampilkan detail data denda
    public function show($id)
    {
        $denda = Denda::findOrFail($id);
        return view('denda.show', compact('denda'));
    }

    // Menampilkan form untuk mengedit denda
    public function edit($id)
    {
        $denda = Denda::findOrFail($id);
        return view('denda.edit', compact('denda'));
    }

    // Mengupdate data denda yang ada
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_denda' => 'required|string|max:255',
            'biaya' => 'required|numeric',
        ]);

        $denda = Denda::findOrFail($id);
        $denda->update($request->all());
        return redirect()->route('denda.index')->with('success', 'Denda berhasil diupdate.');
    }

    // Menghapus data denda
    public function destroy($id)
    {
        $denda = Denda::findOrFail($id);
        $denda->delete();
        return redirect()->route('denda.index')->with('success', 'Denda berhasil dihapus.');
    }
}
