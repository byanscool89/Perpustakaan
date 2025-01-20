@extends('layout.main')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Pengembalian</h1>
        <a href="{{ route('pengembalian.create') }}" class="btn btn-secondary">
            Tambah Pengembalian
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Pengembalian</th>
                <th>ID Peminjaman</th>
                <th>Kategori Denda</th>
                <th>Nama Petugas</th>
                <th>Tanggal Dikembalikan</th>
                <th>Biaya Denda</th>
           
            </tr>
        </thead>
        <tbody>
            @foreach($pengembalian as $data)
                <tr>
                    <td>{{ $data->id_pengembalian }}</td>
                    <td>{{ $data->id_peminjaman }}</td>
                    <td>{{ $data->denda->kategori_denda ?? '-' }}</td>
                    <td>{{ $data->user->name }}</td>
                    <td>{{ $data->tgl_dikembalikan ?? '-' }}</td>
                    <td>{{ $data->denda->biaya }}</td>
                    <td>
                        {{-- <a href="{{ route('pengembalian.edit', $data->id_pengembalian) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                        {{-- <form action="{{ route('pengembalian.destroy', $data->id_pengembalian) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
