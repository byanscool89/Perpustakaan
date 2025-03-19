<!-- resources/views/rak/index.blade.php -->
@extends('layout.main')

@section('content')
{{-- <div class="container">
    <h1>Daftar Rak</h1>
    <a href="{{ route('rak.create') }}" class="btn btn-primary mb-3">Tambah Rak</a> --}}
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Daftar Rak</h1>
            <a href="{{ route('rak.create') }}" class="btn btn-secondary">
                Tambah Rak
            </a>
        </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Rak</th>
                <th>Nama Rak</th>
                <th>Lokasi Rak</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rak as $item)
            <tr>
                <td>{{ $item->id_rak }}</td>
                <td>{{ $item->nama_rak }}</td>
                <td>{{ $item->lokasi_rak }}</td>
                <td>
                    <a href="{{ route('rak.edit', $item->id_rak) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                    <form action="{{ route('rak.destroy', $item->id_rak) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
