@extends('layout.main')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Pengembalian</h1>
        <a href="{{ route('pengembalian.create') }}" class="btn btn-secondary">
            Tambah Pengembalian
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Peminjaman</th>
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
