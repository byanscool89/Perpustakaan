<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

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
    public function lihatbuku()
    {
        $bukus = Buku::join('tb_kategori', 'tb_kategori.id_kategori', '=', 'tb_buku.id_kategori')
            ->join('tb_rak', 'tb_rak.id_rak', '=', 'tb_buku.id_rak')
            ->select('tb_buku.*', 'tb_rak.nama_rak', 'tb_kategori.nama_kategori')
            ->get();

        return view('lihatbuku', compact('bukus')); // Sesuaikan nama variabel dengan view
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        // Query pencarian
        $buku = Buku::where('id_buku', 'like', "%$keyword%")
            ->orWhere('judul', 'like', "%$keyword%")
            ->orWhere('isbn', 'like', "%$keyword%")
            ->orWhere('penulis', 'like', "%$keyword%")
            ->orWhere('penerbit', 'like', "%$keyword%")
            ->orWhere('tahun_terbit', 'like', "%$keyword%")
            ->get();

        // Kembalikan hasil ke view
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
            'judul' => 'required',
            'isbn' => 'required|string|max:100',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required',
            'id_kategori' => 'required',
            'id_rak' => 'required',
        ]);

        // Cek apakah buku dengan ISBN ini sudah ada
        $existingBuku = Buku::where('isbn', $validated['isbn'])->first();

        if ($existingBuku) {
            return redirect()->route('buku.index')->with('warning', 'Buku sudah ada dalam database.');
        }

        // Generate ID Buku otomatis
        $last = Buku::count();
        $newBook = 'BK' . str_pad($last + 1, 3, '0', STR_PAD_LEFT);

        Buku::create([
            'id_buku' => $newBook,
            'judul' => $request->judul,
            'isbn' => $validated['isbn'],
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'stok' => $request->stok,
            'id_kategori' => $request->id_kategori,
            'id_rak' => $request->id_rak,
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

    public function history(Request $request)
    {

        $keyword = $request->input('keyword');

        // Cek apakah user sudah melakukan pencarian atau belum
        if ($keyword) {
            $peminjaman = Peminjaman::with(['anggota', 'buku', 'pengembalian.denda'])
                ->where('id_peminjaman', 'like', "%$keyword%")
                ->orWhere('status', 'like', "%$keyword%")
                ->orWhereHas('anggota', function ($query) use ($keyword) {
                    $query->where('nama_anggota', 'like', "%$keyword%");
                })
                ->orWhereHas('buku', function ($query) use ($keyword) {
                    $query->where('judul', 'like', "%$keyword%");
                })
                ->get();
        } else {
            $peminjaman = collect(); // Kalau belum search, tabel kosong
        }

        return view('history', compact('peminjaman'));
    }


    // public function history()
    // {
    //     // $pengembalian = Pengembalian::all();
    //     // $peminjaman = Peminjaman::all();
    //     $peminjaman = Peminjaman::with(['anggota', 'buku', 'pengembalian.denda'])->get();

    //     return view('history', compact( 'peminjaman'));
    // }

    // public function historysearch(Request $request)
    // {
    //     $keyword = $request->input('keyword');

    //     // Query pencarian
    //     $peminjaman = Peminjaman::where('id_peminjaman', 'like', "%$keyword%")
    //         // ->orWhere('nama_anggota', 'like', "%$keyword%")
    //         // ->orWhere('judul', 'like', "%$keyword%")
    //         // ->orWhere('penulis', 'like', "%$keyword%")
    //         // ->orWhere('penerbit', 'like', "%$keyword%")
    //         ->orWhere('status', 'like', "%$keyword%")
    //         ->get();

    //     // Kembalikan hasil ke view
    //     return view('history', compact('peminjaman'));
    // }
    public function historysearch(Request $request)
    {
        $keyword = $request->input('keyword');

        $peminjaman = Peminjaman::with(['anggota', 'buku', 'pengembalian.denda'])
            ->where('id_peminjaman', 'like', "%$keyword%")
            ->orWhere('status', 'like', "%$keyword%")
            ->orWhereHas('anggota', function ($query) use ($keyword) {
                $query->where('nama_anggota', 'like', "%$keyword%");
            })
            ->orWhereHas('buku', function ($query) use ($keyword) {
                $query->where('judul', 'like', "%$keyword%");
            })
            ->get();

        return view('history', compact('peminjaman'));
    }

    public function caribuku(Request $request)
    {
        $keyword = $request->input('keyword');

        $bukus = Buku::join('tb_kategori', 'tb_kategori.id_kategori', '=', 'tb_buku.id_kategori')
            ->join('tb_rak', 'tb_rak.id_rak', '=', 'tb_buku.id_rak')
            ->select('tb_buku.*', 'tb_rak.nama_rak', 'tb_kategori.nama_kategori')
            ->where(function ($query) use ($keyword) {
                $query->where('tb_buku.judul', 'like', "%$keyword%")
                    ->orWhere('tb_buku.penulis', 'like', "%$keyword%")
                    ->orWhere('tb_buku.penerbit', 'like', "%$keyword%")
                    ->orWhere('tb_kategori.nama_kategori', 'like', "%$keyword%")
                    ->orWhere('tb_rak.nama_rak', 'like', "%$keyword%");
            })
            ->get();

        return view('lihatbuku', compact('bukus', 'keyword'));
    }
}