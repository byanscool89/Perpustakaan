<!-- resources/views/rak/edit.blade.php -->
@extends('layout.main')

@section('content')
<div class="container">
    <h1>Edit Rak</h1>
    <form action="{{ route('rak.update', $rak->id_rak) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_rak" class="form-label">Nama Rak</label>
            <input type="text" class="form-control" id="nama_rak" name="nama_rak" value="{{ $rak->nama_rak }}">
        </div>
        <div class="mb-3">
            <label for="lokasi_rak" class="form-label">Lokasi Rak</label>
            <input type="text" class="form-control" id="lokasi_rak" name="lokasi_rak" value="{{ $rak->lokasi_rak }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('rak.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
