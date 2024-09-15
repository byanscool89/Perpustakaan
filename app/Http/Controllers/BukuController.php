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
        $buku = Buku::all();
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

        $newBook = '';
        $lastBook = Buku::where('id_buku', 'LIKE', 'RAK%')
                      ->orderBy('id_buku', 'desc')
                      ->first();

        // Generate a new id_buku
        if ($lastBook) {
            // Extract the number part from the last id_buku and increment it
            $lastIdNumber = (int) substr($lastBook->id_buku, 3);
            $newIdNumber = $lastIdNumber + 1;
            $newBook = 'BK' . str_pad($newIdNumber, 3, '0', STR_PAD_LEFT);
        } else {
            // If no rak exists, start with RAK001
            $newBook = 'BK001';
        }

        Buku::create([
            'id_buku' => $newBook,
            'judul' => $validated['judul'],
            'isbn' => $validated['isbn'],
            'penulis' => $validated['isbn'],
            'penerbit' => $validated['isbn'],
            'tahun_terbit' =>$validated['isbn'] ,
            'stok' =>$validated['isbn'] ,
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan');
    }

    // Display the specified book
    public function show($id)
    {
        $buku = Buku::findOrFail($id);
        return view('buku.show', compact('buku'));
    }

    // Show the form for editing the specified book
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('buku.edit', compact('buku'));
    }

    // Update the specified book in storage
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:100',
            'isbn' => 'nullable|string|max:100',
            'penulis' => 'required|string|max:100',
            'penerbit' => 'required|string|max:100',
            'tahun_terbit' => 'nullable|integer|min:1000|max:9999',
            'stok' => 'nullable|integer|min:0',
        ]);

        Buku::where('id_buku', $id)->update($validated);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui');
    }

    // Remove the specified book from storage
    public function destroy($id)
    {
        Buku::destroy($id);
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus');
    }
}
