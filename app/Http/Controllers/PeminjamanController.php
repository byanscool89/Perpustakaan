<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil keyword dari input pencarian
        $keyword = $request->input('keyword');

        // Query peminjaman dengan join ke tb_anggota dan tb_buku
        $peminjaman = Peminjaman::join('tb_anggota', 'tb_anggota.id_anggota', '=', 'tb_peminjaman.id_anggota')
            ->join('tb_buku', 'tb_buku.id_buku', '=', 'tb_peminjaman.id_buku')
            ->select('tb_peminjaman.*', 'tb_buku.judul', 'tb_anggota.nama_anggota')
            ->where('tb_peminjaman.status', 'dipinjam') // Filter berdasarkan status dipinjam
            ->when($keyword, function ($query, $keyword) {
                $query->where('tb_anggota.nama_anggota', 'like', "%$keyword%")
                    ->orWhere('tb_buku.judul', 'like', "%$keyword%")
                    ->orWhere('tb_peminjaman.id_peminjaman', 'like', "%$keyword%");
            })
            ->get();

        // Return data ke view
        return view('peminjaman.index', compact('peminjaman'));
    }



    public function create()
    {
        $anggota = Anggota::all();
        $buku = Buku::all();

        return view('peminjaman.create', compact('anggota', 'buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_anggota' => 'required',
            'id_buku' => 'required',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'nullable|date|after_or_equal:tgl_pinjam',
        ]);

        // cek stok buku
        $buku = Buku::where('id_buku', $request->id_buku)->first();
        if (!$buku || $buku->stok <= 0) {
            return redirect()->back()->with('error', 'Stok buku habis, tidak dapat melakukan peminjaman.');
        }

        // Generate ID Peminjaman
        $last = Peminjaman::count();
        $idPeminjaman = 'PJM' . str_pad($last + 1, 3, '0', STR_PAD_LEFT);

        // Simpan Data Peminjaman
        $peminjaman = Peminjaman::create([
            'id_peminjaman' => $idPeminjaman,
            'id_anggota' => $request->id_anggota,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali,
            'id_petugas' => Auth::user()->id_petugas,
            'status' => 'dipinjam',
            'id_buku' => $request->id_buku,
        ]);

        // Kurangi Stok Buku
        // Buku::where('id_buku', $request->id_buku)->decrement('stok', 1);
        $buku->decrement('stok', 1);

        // Generate QR Code
        $qrCode = QrCode::format('svg')->size(200)->generate($peminjaman->id_peminjaman);
        // $path = public_path('qrcodes/' . $peminjaman->id_peminjaman . '.svg');
        $path = base_path('public_html/qrcodes/' . $peminjaman->id_peminjaman . '.svg');
        file_put_contents($path, $qrCode);
        // Simpan QR Code ke Public Folder
        file_put_contents($path, $qrCode);

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil disimpan');
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return view('peminjaman.show', compact('peminjaman'));
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $anggota = Anggota::all();
        $buku = Buku::all();
        return view('peminjaman.edit', compact('peminjaman', 'anggota', 'buku'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'nullable|date|after_or_equal:tgl_pinjam',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update($request->all());

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diubah');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus');
    }

    public function lapPeminjaman(Request $request)
    {
        // $keyword = $request->input('keyword');
        // $peminjaman = Peminjaman::join('tb_anggota', 'tb_anggota.id_anggota', '=', 'tb_peminjaman.id_anggota')
        //     ->join('tb_buku', 'tb_buku.id_buku', '=', 'tb_peminjaman.id_buku')
        //     ->select('tb_peminjaman.*', 'tb_buku.judul', 'tb_anggota.nama_anggota')
        //     ->where('tb_peminjaman.status', 'dipinjam')
        //     ->when($keyword, function ($query, $keyword) {
        //         $query->where('tb_anggota.nama_anggota', 'like', "%$keyword%")
        //             ->orWhere('tb_buku.judul', 'like', "%$keyword%")
        //             ->orWhere('tb_peminjaman.id_peminjaman', 'like', "%$keyword%");
        //     })
        //     ->get();
        $peminjaman = Peminjaman::with('buku','anggota')->get();
        return view('laporan_peminjaman.index', compact('peminjaman'));
    }
    public function filter(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $query = Peminjaman::query();

        // Ambil data berdasarkan rentang tanggal yang dipilih
        // $peminjaman = Peminjaman::whereDate('created_at', '>=', $start_date)
        //     ->whereDate('created_at', '<=', $end_date)
        //     ->get();

        // Cek apakah filter tanggal diisi
        if (!empty($start_date) && !empty($end_date)) {
            $query->whereBetween('tgl_pinjam', [$start_date, $end_date]);
        }

        // Ambil data pengembalian
        // $pengembalian = $query->with(['anggota', 'buku'])->get();
        $peminjaman = $query->get();
        // return response()->json($peminjaman);

        // Kirim data ke tampilan
        return view('laporan_peminjaman.index', compact('peminjaman', 'start_date', 'end_date'));
    }
    // public function filterprint(Request $request) {
    //     $start_date = $request->start_date;
    //     $end_date = $request->end_date;

    //     // Ambil data berdasarkan rentang tanggal yang dipilih
    //     $peminjaman = Peminjaman::whereDate('created_at', '>=', $start_date)
    //         ->whereDate('created_at', '<=', $end_date)
    //         ->get();

    //     // Kirim data ke tampilan
    //     return view('laporan_peminjaman.print', compact('peminjaman', 'start_date', 'end_date'));
    // }
    public function print()
    {
        $peminjaman = Peminjaman::with(['anggota', 'buku'])->get();
        return view('laporan_peminjaman.print', compact('peminjaman'));
    }
}