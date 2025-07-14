<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Denda;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    // Menampilkan semua data pengembalian
    public function index()
    {
        $pengembalian = Pengembalian::all();
        return view('pengembalian.index', compact('pengembalian'));
    }

    // Menampilkan form untuk tambah data pengembalian
    public function create()
    {
        // Ambil data peminjaman yang belum dikembalikan
        $peminjaman = Peminjaman::all()->where('status', 'dipinjam');
        // Ambil semua jenis denda
        $denda = Denda::all();
        return view('pengembalian.create', compact('peminjaman', 'denda'));
    }

    // Menampilkan form edit data pengembalian
    public function edit($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $denda = Denda::all(); 
        return view('pengembalian.edit', compact('pengembalian','denda'));
    }

    // Memproses pembaruan data pengembalian
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'id_peminjaman' => 'required|integer',
            'id_denda' => 'required|integer',
            'id_petugas' => 'required|integer',
            'tgl_dikembalikan' => 'required|date',
            'biaya_denda' => 'required|numeric|min:0',
        ]);

        // Update data pengembalian
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->update([
            'id_peminjaman' => $request->id_peminjaman,
            'id_denda' => $request->id_denda,
            'id_petugas' => $request->id_petugas,
            'tgl_dikembalikan' => $request->tgl_dikembalikan,
            'biaya_denda' => $request->biaya_denda,
        ]);

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil diperbarui.');
    }

    // Menghapus data pengembalian
    public function destroy($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->delete();

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian berhasil dihapus.');
    }

    // Menyimpan data pengembalian baru
    public function store(Request $request)
    {
        // Validasi input
        $cek = $request->validate([
            'tgl_dikembalikan' => 'required|date',
            'id_peminjaman' => 'required',
            'id_denda' => 'required',
        ]);

        // Ambil data peminjaman berdasarkan ID
        $getPeminjaman = Peminjaman::where('id_peminjaman', $request->id_peminjaman)->first();
        if (!$getPeminjaman) {
            return redirect()->back()->with('error', 'Peminjaman tidak ditemukan.');
        }

        // Ambil data buku dari peminjaman
        $id_buku = $getPeminjaman->id_buku;

        // Generate ID pengembalian otomatis
        $last = Pengembalian::count();
        $idPengembalian = 'PBM' . str_pad($last + 1, 3, '0', STR_PAD_LEFT);

        // Hitung denda keterlambatan (jika ada)
        $tgl_kembali = $getPeminjaman->tgl_kembali;
        $tgl_dikembalikan = $request->tgl_dikembalikan;
        $denda_terlambat = Denda::where('id_denda', $request->id_denda)->first()->biaya;

        $tgl_kembali_carbon = Carbon::createFromFormat('Y-m-d', $tgl_kembali);
        $tgl_dikembalikan_carbon = Carbon::createFromFormat('Y-m-d', $tgl_dikembalikan);

        // Jika dikembalikan lewat dari tanggal kembali, hitung denda
        $jml_denda = $tgl_dikembalikan_carbon->greaterThan($tgl_kembali_carbon) ? 
                     $denda_terlambat * $tgl_dikembalikan_carbon->diffInDays($tgl_kembali_carbon) : 0;

        // Simpan data pengembalian
        Pengembalian::create([
            'id_petugas' => Auth::user()->id_petugas,
            'id_pengembalian' => $idPengembalian,
            'id_peminjaman' => $request->id_peminjaman,
            'tgl_dikembalikan' => $tgl_dikembalikan,
            'id_denda' => $request->id_denda,
            'biaya_denda' => $jml_denda,
            'id_buku' => $id_buku,
        ]);

        // Update status peminjaman menjadi "dikembalikan"
        Peminjaman::where('id_peminjaman', $request->id_peminjaman)->update(['status' => 'dikembalikan']);

        // Tambah stok buku yang dikembalikan
        Buku::where('id_buku', $id_buku)->increment('stok', 1);

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil disimpan');
    }

    // Menampilkan laporan pengembalian
    public function lapPengembalian(Request $request)
    {
        // Ambil data pengembalian beserta relasi peminjamannya
        $pengembalian = Pengembalian::with('peminjaman')->get();
        $buku = Buku::all();
        return view('laporan_pengembalian.index', compact('pengembalian','buku'));
    }

    // Filter laporan pengembalian berdasarkan rentang tanggal
    public function filter(Request $request) {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $query = Pengembalian::query();

        // Filter jika tanggal diisi
        if (!empty($start_date) && !empty($end_date)) {
            $query->whereBetween('tgl_dikembalikan', [$start_date, $end_date]);
        }

        // Ambil hasil filter
        $pengembalian = $query->get();

        // Kirim ke tampilan
        return view('laporan_pengembalian.index', compact('pengembalian', 'start_date', 'end_date'));
    }

    // Cetak laporan pengembalian
    public function print()
    {
        // Ambil data pengembalian beserta relasi anggota & buku
        $pengembalian = Pengembalian::with(['peminjaman.anggota', 'buku'])->get();
        return view('laporan_pengembalian.print', compact('pengembalian'));
    }
}
