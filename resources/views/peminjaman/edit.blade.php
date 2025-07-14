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
            <label for="id_anggota" class="form-label">Nama Anggota</label>
            <select class="form-control" id="id_anggota" name="id_anggota" required>
                <option value="">-- Pilih Anggota --</option>
                @foreach($anggota as $item)
                    <option value="{{ $item->id_anggota }}" 
                        {{ $item->id_anggota == $peminjaman->id_anggota ? 'selected' : '' }}>
                        {{ $item->nama_anggota }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="id_buku" class="form-label">Judul Buku</label>
            <select class="form-control" id="id_buku" name="id_buku" required>
                <option value="">-- Pilih Buku --</option>
                @foreach($buku as $item)
                    <option value="{{ $item->id_buku }}" 
                        {{ $item->id_buku == $peminjaman->id_buku ? 'selected' : '' }}>
                        {{ $item->judul }}
                    </option>
                @endforeach
            </select>
        </div>
        


        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
