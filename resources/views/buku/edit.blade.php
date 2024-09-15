@extends('layout.main')
@section('title', 'Edit Buku')

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">Edit Buku</h1>
    <form action="{{ route('buku.update', $buku->id_buku) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Buku</label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul }}" required>
        </div>
        <div class="mb-3">
            <label for="isbn" class="form-label">No ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" value="{{ $buku->isbn }}">
        </div>
        <div class="mb-3">
            <label for="penulis" class="form-label">Nama Penulis</label>
            <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $buku->penulis }}" required>
        </div>
        <div class="mb-3">
            <label for="penerbit" class="form-label">Nama Penerbit</label>
            <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ $buku->penerbit }}" required>
        </div>
        <div class="mb-3">
            <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
            <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" value="{{ $buku->tahun_terbit }}">
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" value="{{ $buku->stok }}">
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">Pilih Kategori</label>
            <select class="form-select" id="id_kategori" name="kategori" required>
                <option value="" selected disabled>Pilih Kategori</option>
                @foreach ($optionKategori as $kategori)
                    <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="rak" class="form-label">Pilih Rak</label>
            <select class="form-select" id="id_rak" name="rak" required>
                <option value="" selected disabled>Pilih Rak</option>
                @foreach ($optionRak as $rak)
                <option value="{{ $rak->id_rak }}">{{ $rak->nama_rak }}</option>
            @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
