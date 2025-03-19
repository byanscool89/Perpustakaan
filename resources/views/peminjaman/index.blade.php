@extends('layout.main')

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Daftar Peminjaman</h1>
            <a href="{{ route('peminjaman.create') }}" class="btn btn-secondary">
                Tambah Peminjaman
            </a>
        </div>
        <form action="{{ route('peminjaman.index') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" name="keyword" class="form-control" placeholder="Cari peminjaman..."
                    value="{{ request('keyword') }}">
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
        </form>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode Peminjaman</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Nama Anggota</th>
                    <th>Judul Buku</th>
                    <th>QR CODE</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjaman as $item)
                    <tr>
                        <td>{{ $item->id_peminjaman }}</td>
                        <td>{{ $item->tgl_pinjam }}</td>
                        <td>{{ $item->tgl_kembali }}</td>
                        <td>{{ $item->nama_anggota }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>
                            <img src="{{ asset('qrcodes/' . $item->id_peminjaman . '.png') }}" width="100"
                                alt="QR Code">
                        </td>
                        <td>
                            <a href="{{ route('peminjaman.edit', $item->id_peminjaman) }}"
                                class="btn btn-warning btn-sm text-white">Edit</a>
                            <form action="{{ route('peminjaman.destroy', $item->id_peminjaman) }}" method="POST"
                                class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection
