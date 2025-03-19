@extends('layout.main')
@section('title', 'Daftar Anggota')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Anggota</h1>
        <a href="{{ route('anggota.create') }}" class="btn btn-secondary">
            Tambah Anggota
        </a>
    </div>
    <form action="{{ route('anggota.search') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" name="keyword" class="form-control" placeholder="Cari anggota..." value="{{ request('keyword') }}">
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>No Telepon</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        @foreach ($anggota as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_anggota }}</td>
            <td>{{ $item->jk_kelamin }}</td>
            <td>{{ $item->alamat_anggota }}</td>
            <td>{{ $item->no_telp }}</td>
            <td>{{ $item->status_anggota }}</td>
            <td>
                <a href="{{ route('anggota.edit', $item->id_anggota) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                <form action="{{ route('anggota.destroy', $item->id_anggota) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
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
