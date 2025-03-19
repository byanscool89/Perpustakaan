<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    // Display a listing of the categories
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }

    // Show the form for creating a new category
    public function create()
    {
        return view('kategori.create');
    }

    // Store a newly created category in the database
    public function store(Request $request)
    {
        $cek = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);


        $lastKategori = Kategori::orderBy('id_kategori', 'desc')->first();
        if ($lastKategori) {
            $lastIdNumber = (int) substr($lastKategori->id_kategori, 3);
            $newIdNumber = $lastIdNumber + 1;
            $newIdKategori = 'KTG' . str_pad($newIdNumber, 3, '0', STR_PAD_LEFT);
        } else {
            $newIdKategori = 'KTG001';
        }

        Kategori::create([
            'id_kategori' => $newIdKategori,
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    // Show the form for editing the specified category
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    // Update the specified category in the database
    public function update(Request $request, $id)
{
    // dd($request->all());
    $request->validate([
        'nama_kategori' => 'required|string|max:255',
    ]);

    // Jika id menggunakan format KTG, pastikan disesuaikan
    // $id = 'KTG' . str_pad((int)$id, 3, '0', STR_PAD_LEFT);

    $kategori = Kategori::where('id_kategori', $id)->firstOrFail();
    $kategori->update([
        'nama_kategori' => $request->nama_kategori,
    ]);

    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui');
}

    // Remove the specified category from the database
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }

    // public function search (Request   $request) {
    //     $keyword = $request->input('keyword');

    //     // Query pencarian
    //     $kategori = Kategori::where('id_kategori', 'like', "%$keyword%")
    //         ->orWhere('nama_kategori', 'like', "%$keyword%")
    //         ->get();

    //     // Kembalikan hasil ke view
    //     return view('kategori.index', compact('kategori'));

    // }
}
