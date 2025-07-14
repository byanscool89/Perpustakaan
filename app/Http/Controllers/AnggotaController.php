<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    // Menampilkan semua data anggota
    public function index()
    {
        $anggota = Anggota::all(); // Mengambil semua data dari tabel anggota
        return view('anggota.index', compact('anggota')); // Mengirim data ke view
    }

    // Menampilkan form untuk menambahkan anggota baru
    public function create()
    {
        return view('anggota.create'); // Menampilkan halaman form tambah anggota
    }

    // Fitur pencarian anggota berdasarkan beberapa field
    public function search(Request $request)
    {
        $keyword = $request->input('keyword'); // Mengambil input keyword dari form

        // Melakukan pencarian pada beberapa kolom di tabel anggota
        $anggota = Anggota::where('id_anggota', 'like', "%$keyword%")
            ->orWhere('nama_anggota', 'like', "%$keyword%")
            ->orWhere('jk_kelamin', 'like', "%$keyword%")
            ->orWhere('alamat_anggota', 'like', "%$keyword%")
            ->orWhere('no_telp', 'like', "%$keyword%")
            ->orWhere('status_anggota', 'like', "%$keyword%")
            ->get();

        return view('anggota.index', compact('anggota')); // Menampilkan hasil pencarian ke view
    }

    // Menyimpan data anggota baru ke database
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nama_anggota' => 'required|string|max:100',
            'jk_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'alamat_anggota' => 'nullable|string|max:100',
            'no_telp' => 'nullable|string|max:15',
            'status_anggota' => 'required|in:siswa,karyawan',
        ]);

        // Generate ID otomatis, misal: AGT001, AGT002, dst
        $last = Anggota::count(); // Menghitung jumlah anggota yang ada
        $idAnggota = 'AGT' . str_pad($last + 1, 3, '0', STR_PAD_LEFT); // Format ID

        // Simpan data ke database
        Anggota::create([
            'id_anggota' => $idAnggota,
            'nama_anggota' => $request->nama_anggota,
            'jk_kelamin' => $request->jk_kelamin,
            'alamat_anggota' => $request->alamat_anggota,
            'no_telp' => $request->no_telp,
            'status_anggota' => $request->status_anggota,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    // Menampilkan form edit untuk anggota tertentu
    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id); // Cari anggota berdasarkan ID, gagal jika tidak ditemukan
        return view('anggota.edit', compact('anggota')); // Kirim data ke view edit
    }

    // Menyimpan perubahan dari form edit
    public function update(Request $request, $id)
    {
        // Validasi input form edit
        $validated = $request->validate([
            'nama_anggota' => 'required|string|max:255',
            'jk_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'alamat_anggota' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'status_anggota' => 'required|in:siswa,karyawan',
        ]);

        // Update data di database berdasarkan ID
        Anggota::where('id_anggota', $id)->update($validated);

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil diperbarui.');
    }

    // Menghapus data anggota berdasarkan ID
    public function destroy($id)
    {
        Anggota::destroy($id); // Hapus dari database
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus.');
    }
}
