@extends('layout.main')
@section('title', 'Edit Buku')

@section('content')
<div class="container">
    <h1>Edit Peminjaman</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('peminjaman.update', $peminjaman->id_peminjaman) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="id_peminjaman" class="form-label">ID Peminjaman</label>
            <input type="text" class="form-control" id="id_peminjaman" name="id_peminjaman" value="{{ $peminjaman->id_peminjaman }}" readonly>
        </div>
        <div class="mb-3">
            <label for="tgl_pinjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" value="{{ $peminjaman->tgl_pinjam }}" required>
        </div>
        <div class="mb-3">
            <label for="tgl_kembali" class="form-label">Tanggal Kembali</label>
            <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" value="{{ $peminjaman->tgl_kembali }}">
        </div>
        <div class="mb-3">
            <label for="nama_anggota" class="form-label">Nama Anggota</label>
            <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" value="{{ $peminjaman->nama_anggota }}">
        </div>
        <div class="mb-3">
            <label for="judul_buku" class="form-label">Tanggal Kembali</label>
            <input type="text" class="form-control" id="judul_buku" name="judul_buku" value="{{ $peminjaman->judul_buku }}">
        </div>


        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
