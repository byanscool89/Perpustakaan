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
    public function index()
    {
        $pengembalian = Pengembalian::all();
        return view('pengembalian.index', compact('pengembalian'));
    }

    public function create()
    {
        $peminjaman = Peminjaman::all()->where('status', 'dipinjam');
        $denda = Denda::all();
        return view('pengembalian.create', compact('peminjaman', 'denda'));
    }

    public function store(Request $request)
    {
        $cek = $request->validate([
            'tgl_dikembalikan' => 'required|date',
            'id_peminjaman' => 'required',
            'id_denda' => 'required',
        ]);

        $getPeminjaman = Peminjaman::where('id_peminjaman', $request->id_peminjaman)->first();
        $id_buku = $getPeminjaman->id_buku;

        $last = Pengembalian::count();
        $idPengembalian = 'PBM' . str_pad($last + 1, 3, '0', STR_PAD_LEFT);

        // ambil tgl_kembali dari tb_peminjaman
        $tgl_kembali = Peminjaman::where('id_peminjaman', $request->id_peminjaman)->first()->tgl_kembali;
        // ambil tgl_dikembalikan dari inputan
        $tgl_dikembalikan = $request->tgl_dikembalikan;
        // ambil biaya di tb_denda
        $denda_terlambat = Denda::where('id_denda', $request->id_denda)->first()->biaya;

        // string tanggal di convert ke carbon, biar bisa di operasikan
        $tgl_kembali_carbon = Carbon::createFromFormat('Y-m-d', $tgl_kembali);
        $tgl_dikembalikan_carbon = Carbon::createFromFormat('Y-m-d', $tgl_dikembalikan);

        // diinisialisasi dulu jumlah denda nya = 0
        $jml_denda = 0;

        // ini baca saja if nya
        if ($tgl_dikembalikan_carbon->greaterThan($tgl_kembali_carbon)) {
            $hari_terlambat = $tgl_dikembalikan_carbon->diffInDays($tgl_kembali_carbon);
            $jml_denda = $denda_terlambat * $hari_terlambat;
        }

        // ini if untuk menentukan kategori denda
        $kategori_denda = Denda::where('id_denda', $request->id_denda)->first()->kategori_denda;
        if ($kategori_denda == 'Terlambat') {
            $total_denda = $jml_denda;
        } else {
            $denda_lain = Denda::where('id_denda', $request->id_denda)->first()->biaya;
            $total_denda = $denda_lain;
        }

        Pengembalian::create([
            'id_petugas' => Auth::user()->id_petugas,
            'id_pengembalian' => $idPengembalian,
            'id_peminjaman' => $request->id_peminjaman,
            'tgl_dikembalikan' => $request->tgl_dikembalikan,
            'id_denda' => $request->id_denda,
            'biaya_denda' => $total_denda,
            'id_buku' => $id_buku,
        ]);

        Peminjaman::where('id_peminjaman', $request->id_peminjaman)
            ->update([
                'status' => 'dikembalikan',
            ]);

        Buku::where('id_buku', $id_buku)->increment('stok', 1);

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil disimpan');
    }

    public function lapPengembalian(Request $request)
    {
        $keyword = $request->input('keyword');
        $pengembalian = Peminjaman::join('tb_anggota', 'tb_anggota.id_anggota', '=', 'tb_peminjaman.id_anggota')
            ->join('tb_buku', 'tb_buku.id_buku', '=', 'tb_peminjaman.id_buku')
            ->select('tb_peminjaman.*', 'tb_buku.judul', 'tb_anggota.nama_anggota')
            ->where('tb_peminjaman.status', 'dikembalikan')
            ->when($keyword, function ($query, $keyword) {
                $query->where('tb_anggota.nama_anggota', 'like', "%$keyword%")
                    ->orWhere('tb_buku.judul', 'like', "%$keyword%")
                    ->orWhere('tb_peminjaman.id_peminjaman', 'like', "%$keyword%");
            })
            ->get();
        return view('laporan_pengembalian.index', compact('pengembalian'));
    }
}
