<!-- resources/views/rak/create.blade.php -->
@extends('layout.main')

@section('content')
    <div class="container">
        <h1>Tambah Rak Baru</h1>
        <form action="{{ route('rak.store') }}" method="POST">
            @csrf
            {{-- <div class="mb-3">
            <label for="id_rak" class="form-label">ID Rak</label>
            <input type="text" class="form-control" id="id_rak" name="id_rak" value="{{ old('id_rak') }}" required>
        </div> --}}
            <div class="mb-3">
                <label for="nama_rak" class="form-label">Nama Rak</label>
                <input type="text" class="form-control" id="nama_rak" name="nama_rak" value="{{ old('nama_rak') }}">
            </div>
            <div class="mb-3">
                <label for="lokasi_rak" class="form-label">Lokasi Rak</label>
                <input type="text" class="form-control" id="lokasi_rak" name="lokasi_rak"
                    value="{{ old('lokasi_rak') }}">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('rak.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
