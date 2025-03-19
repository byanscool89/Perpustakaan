@extends('layout.main')
@section('title', 'Edit Kategori')

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">Edit Kategori</h1>
    <form action="{{ route('kategori.update', $kategori->id_kategori) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="judul" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="kategori" name="nama_kategori" value="{{ $kategori->nama_kategori }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
