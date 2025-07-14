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
    // Menampilkan semua data buku ke halaman admin
    public function index()
    {
        $buku = Buku::join('tb_kategori', 'tb_kategori.id_kategori', '=', 'tb_buku.id_kategori')
            ->join('tb_rak', 'tb_rak.id_rak', '=', 'tb_buku.id_rak')
            ->select('tb_buku.*', 'tb_rak.nama_rak', 'tb_kategori.nama_kategori')
            ->get();

        return view('buku.index', compact('buku'));
    }

    // Menampilkan semua buku ke halaman pengunjung
    public function lihatbuku()
    {
        $bukus = Buku::join('tb_kategori', 'tb_kategori.id_kategori', '=', 'tb_buku.id_kategori')
            ->join('tb_rak', 'tb_rak.id_rak', '=', 'tb_buku.id_rak')
            ->select('tb_buku.*', 'tb_rak.nama_rak', 'tb_kategori.nama_kategori')
            ->get();

        return view('lihatbuku', compact('bukus')); // variabel $bukus dipakai di view
    }

    // Mencari buku berdasarkan kata kunci
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $buku = Buku::where('id_buku', 'like', "%$keyword%")
            ->orWhere('judul', 'like', "%$keyword%")
            ->orWhere('isbn', 'like', "%$keyword%")
            ->orWhere('penulis', 'like', "%$keyword%")
            ->orWhere('penerbit', 'like', "%$keyword%")
            ->orWhere('tahun_terbit', 'like', "%$keyword%")
            ->get();

        return view('buku.index', compact('buku'));
    }

    // Menampilkan form tambah buku
    public function create()
    {
        $optionKategori = Kategori::all(); // Ambil semua kategori
        $optionRak = Rak::all(); // Ambil semua rak

        return view('buku.create', compact('optionKategori', 'optionRak'));
    }

    // Menyimpan data buku baru
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

        // Cek apakah ISBN sudah ada
        $existingBuku = Buku::where('isbn', $validated['isbn'])->first();

        if ($existingBuku) {
            return redirect()->route('buku.index')->with('warning', 'Buku sudah ada dalam database.');
        }

        // Generate ID buku otomatis (format: BK001, BK002, dst)
        $last = Buku::count();
        $newBook = 'BK' . str_pad($last + 1, 3, '0', STR_PAD_LEFT);

        // Simpan data ke database
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

    // Menampilkan detail buku berdasarkan ID
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

    // Menampilkan form edit buku
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

    // Menyimpan perubahan buku ke database
    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id); // Cari buku berdasarkan id

        // Update data
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

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui');
    }

    // Menghapus buku
    public function destroy($id)
    {
        Buku::destroy($id);
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus');
    }

    // Menampilkan riwayat peminjaman (fitur pencarian tersedia)
    public function history(Request $request)
    {
        $keyword = $request->input('keyword');

        // Jika ada keyword, lakukan pencarian
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
            $peminjaman = collect(); // Kosong jika belum ada pencarian
        }

        return view('history', compact('peminjaman'));
    }

    // Method khusus untuk pencarian history (bisa digabung dengan atas)
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

    // Fitur pencarian buku untuk user/pengunjung
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
