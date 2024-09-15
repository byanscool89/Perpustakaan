@extends('layout.main')
@section('title', 'Daftar Anggota')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Buku</h1>
        <a href="{{ route('buku.create') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Isbn</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
            <th>Stok Buku</th>
            <th>Kategori</th>
            <th>Rak</th>

            <th>Action</th>
        </tr>

        @foreach ($buku as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->judul }}</td>
            <td>{{ $item->isbn }}</td>
            <td>{{ $item->penulis }}</td>
            <td>{{ $item->penerbit }}</td>
            <td>{{ $item->tahun_terbit }}</td>
            <td>{{ $item->stok }}</td>
            <td>{{ $item->id_kategori }}</td>
             <td>{{ $item->id_rak}}</td>

            <td>
                <a href="{{ route('buku.edit', $item->id_buku) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('buku.destroy', $item->id_buku) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
