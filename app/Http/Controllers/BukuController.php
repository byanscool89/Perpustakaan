<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;

use App\Models\Rak;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    // Display a listing of the books
    public function index()
    {
        $buku = Buku::join('tb_kategori', 'tb_kategori.id_kategori', '=', 'tb_buku.id_kategori')
            ->join('tb_rak', 'tb_rak.id_rak', '=', 'tb_buku.id_rak')
            ->select('tb_buku.*', 'tb_rak.nama_rak', 'tb_kategori.nama_kategori')
            ->get();

        return view('buku.index', compact('buku'));
    }

    public function create()
{
    $optionKategori = Kategori::all();
    $optionRak = Rak::all();

    // Pass both variables to the view
    return view('buku.create', compact('optionKategori', 'optionRak'));
}


    // Store a newly created book in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'id_buku' => 'required|string|max:15',
            'judul' => 'required|string|max:100',
        'isbn' => 'nullable|string|max:100',
        'penulis' => 'required|string|max:100',
        'penerbit' => 'required|string|max:100',
        'tahun_terbit' => 'nullable|integer|min:1000|max:9999',
        'stok' => 'nullable|integer|min:0',
        'id_kategori' => 'nullable|string|max:100',
        'id_rak' => 'nullable|string|max:100',

        ]);

        $last = Buku::count();
        $newBook = 'BK' . str_pad($last + 1, 3, '0', STR_PAD_LEFT);

        Buku::create([
            'id_buku' => $newBook,
            'judul' => $validated['judul'],
            'isbn' => $validated['isbn'],
            'penulis' => $validated['penulis'],
            'penerbit' => $validated['penerbit'],
            'tahun_terbit' =>$validated['tahun_terbit'] ,
            'stok' =>$validated['stok'] ,
            'id_kategori' => $validated['id_kategori'],
            'id_rak' => $validated['id_rak'],

        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan');
    }

    // Display the specified book
    public function show($id)
    {
        $optionKategori = Kategori::all();
        $optionRak = Rak::all();
        $buku = Buku::join('tb_kategori', 'tb_kategori.id_kategori', '=', 'tb_buku.id_kategori')
            ->join('tb_rak', 'tb_rak.id_rak', '=', 'tb_buku.id_rak')
            ->where('tb_buku.id_buku', $id)
            ->select('tb_buku.*', 'tb_rak.*', 'tb_kategori.*')
            ->first();
        return view('buku.show', compact('buku', 'optionKategori', 'optionRak'));
    }

    // Show the form for editing the specified book
    public function edit($id)
    {
        $optionKategori = Kategori::all();
        $optionRak = Rak::all();
        $buku = Buku::join('tb_kategori', 'tb_kategori.id_kategori', '=', 'tb_buku.id_kategori')
            ->join('tb_rak', 'tb_rak.id_rak', '=', 'tb_buku.id_rak')
            ->where('tb_buku.id_buku', $id)
            ->select('tb_buku.*', 'tb_rak.*', 'tb_kategori.*')
            ->first();
        return view('buku.edit', compact('buku', 'optionKategori', 'optionRak'));
    }

    // Update the specified book in storage
    public function update(Request $request, $id)
{

    // Fetch the existing book record
    $buku = Buku::findOrFail($id); // Fetch the book directly without joining

    // Update the book using validated input or fallback to existing values
    $buku->update([
        'judul' => $request->judul ?? $buku->judul,
        'isbn' => $request->isbn ?? $buku->isbn,
        'penulis' => $request->penulis ?? $buku->penulis,
        'penerbit' => $request->penerbit ?? $buku->penerbit,
        'tahun_terbit' => $request->tahun_terbit ?? $buku->tahun_terbit,
        'stok' => $request->stok ?? $buku->stok,
        'id_kategori' => $request->id_kategori ?? $buku->id_kategori,
        'id_rak' => $request->id_rak ?? $buku->id_rak,
    ]);

    // Redirect with success message
    return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui');
}


    // Remove the specified book from storage
    public function destroy($id)
    {
        Buku::destroy($id);
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus');
    }
}
