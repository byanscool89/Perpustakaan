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
    public function edit($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        return view('pengembalian.edit', compact('pengembalian'));
    }

    // Memproses pembaruan data pengembalian
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_peminjaman' => 'required|integer',
            'id_denda' => 'required|integer',
            'id_petugas' => 'required|integer',
            'tgl_dikembalikan' => 'required|date',
            'biaya_denda' => 'required|numeric|min:0',
        ]);

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

    public function destroy($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->delete();

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian berhasil dihapus.');
    }

    public function store(Request $request)
{
    $cek = $request->validate([
        'tgl_dikembalikan' => 'required|date',
        'id_peminjaman' => 'required',
        'id_denda' => 'required',
    ]);

    $getPeminjaman = Peminjaman::where('id_peminjaman', $request->id_peminjaman)->first();
    if (!$getPeminjaman) {
        return redirect()->back()->with('error', 'Peminjaman tidak ditemukan.');
    }

    $id_buku = $getPeminjaman->id_buku;
    $last = Pengembalian::count();
    $idPengembalian = 'PBM' . str_pad($last + 1, 3, '0', STR_PAD_LEFT);
    $tgl_kembali = $getPeminjaman->tgl_kembali;
    $tgl_dikembalikan = $request->tgl_dikembalikan;
    $denda_terlambat = Denda::where('id_denda', $request->id_denda)->first()->biaya;

    $tgl_kembali_carbon = Carbon::createFromFormat('Y-m-d', $tgl_kembali);
    $tgl_dikembalikan_carbon = Carbon::createFromFormat('Y-m-d', $tgl_dikembalikan);
    $jml_denda = $tgl_dikembalikan_carbon->greaterThan($tgl_kembali_carbon) ?
                 $denda_terlambat * $tgl_dikembalikan_carbon->diffInDays($tgl_kembali_carbon) : 0;

    Pengembalian::create([
        'id_petugas' => Auth::user()->id_petugas,
        'id_pengembalian' => $idPengembalian,
        'id_peminjaman' => $request->id_peminjaman,
        'tgl_dikembalikan' => $tgl_dikembalikan,
        'id_denda' => $request->id_denda,
        'biaya_denda' => $jml_denda,
        'id_buku' => $id_buku,
    ]);

    Peminjaman::where('id_peminjaman', $request->id_peminjaman)->update(['status' => 'dikembalikan']);
    Buku::where('id_buku', $id_buku)->increment('stok', 1);

    return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil disimpan');
}

    // public function store(Request $request)
    // {
    //     $cek = $request->validate([
    //         'tgl_dikembalikan' => 'required|date',
    //         'id_peminjaman' => 'required',
    //         'id_denda' => 'required',
    //     ]);

    //     $getPeminjaman = Peminjaman::where('id_peminjaman', $request->id_peminjaman)->first();
    //     $id_buku = $getPeminjaman->id_buku;
    //     $last = Pengembalian::count();
    //     $idPengembalian = 'PBM' . str_pad($last + 1, 3, '0', STR_PAD_LEFT);
    //     $tgl_kembali = Peminjaman::where('id_peminjaman', $request->id_peminjaman)->first()->tgl_kembali;
    //     $tgl_dikembalikan = $request->tgl_dikembalikan;
    //     $denda_terlambat = Denda::where('id_denda', $request->id_denda)->first()->biaya;
    //     $tgl_kembali_carbon = Carbon::createFromFormat('Y-m-d', $tgl_kembali);
    //     $tgl_dikembalikan_carbon = Carbon::createFromFormat('Y-m-d', $tgl_dikembalikan);
    //     $jml_denda = 0;

    //     // ini baca saja if nya
    //     if ($tgl_dikembalikan_carbon->greaterThan($tgl_kembali_carbon)) {
    //         $hari_terlambat = $tgl_dikembalikan_carbon->diffInDays($tgl_kembali_carbon);
    //         $jml_denda = $denda_terlambat * $hari_terlambat;
    //     }

    //     // ini if untuk menentukan kategori denda
    //     $kategori_denda = Denda::where('id_denda', $request->id_denda)->first()->kategori_denda;
    //     if ($kategori_denda == 'Terlambat') {
    //         $total_denda = $jml_denda;
    //     } else {
    //         $denda_lain = Denda::where('id_denda', $request->id_denda)->first()->biaya;
    //         $total_denda = $denda_lain;
    //     }

    //     Pengembalian::create([
    //         'id_petugas' => Auth::user()->id_petugas,
    //         'id_pengembalian' => $idPengembalian,
    //         'id_peminjaman' => $request->id_peminjaman,
    //         'tgl_dikembalikan' => $request->tgl_dikembalikan,
    //         'id_denda' => $request->id_denda,
    //         'biaya_denda' => $total_denda,
    //         'id_buku' => $id_buku,
    //     ]);

    //     Peminjaman::where('id_peminjaman', $request->id_peminjaman)
    //         ->update([
    //             'status' => 'dikembalikan',
    //         ]);

    //     Buku::where('id_buku', $id_buku)->increment('stok', 1);

    //     return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil disimpan');
    // }

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
    public function filter(Request $request) {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $query = Pengembalian::query();

        // Cek apakah filter tanggal diisi
        if (!empty($start_date) && !empty($end_date)) {
            $query->whereBetween('tgl_kembali', [$start_date, $end_date]);
        }

        // Ambil data pengembalian
        $pengembalian = $query->with(['anggota', 'buku'])->get();

        // Kirim data ke tampilan
        return view('laporan_pengembalian.index', compact('pengembalian', 'start_date', 'end_date'));
    }

    public function print(Request $request)
    {
        $query = Pengembalian::query();

        // Filter berdasarkan tanggal jika ada input
        if ($request->has(['start_date', 'end_date'])) {
            $query->whereBetween('tgl_kembali', [$request->start_date, $request->end_date]);
        }

        $pengembalian = $query->with(['anggota', 'buku'])->get();

        return view('laporan_pengembalian.print', compact('pengembalian'));
    }

}
