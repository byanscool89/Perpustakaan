@extends('layout.main')

@section('content')
        <h1>Laporan Pengembalian</h1>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Peminjaman</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengembalian as $item)
             <tr>
                <td>{{ $item->id_peminjaman }}</td>
                <td>{{ $item->tgl_pinjam }}</td>
                <td>{{ $item->tgl_kembali }}</td>
                <td>{{ $item->nama_anggota }}</td>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
