@extends('layout.main')
@section('title', 'create')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('kategori.index') }}" class="btn btn-primary">Daftar Kategori</a>
    </div>
    <h1 class="mb-3">Tambah Kategori Baru</h1>
    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="kategori" name="nama_kategori" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
