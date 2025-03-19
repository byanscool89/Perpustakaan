@extends('layout.main')

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Daftar Denda</h1>
            {{-- <a href="{{ route('denda.create') }}" class="btn btn-secondary">
                Tambah Denda
            </a> --}}
        </div>

        {{-- @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
 --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode Denda</th>
                    <th>Kategori Denda</th>
                    <th>Biaya</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($denda as $item)
                    <tr>
                        <td>{{ $item->id_denda }}</td>
                        <td>{{ $item->kategori_denda }}</td>
                        <td>{{ $item->biaya }}</td>
                        <td>
                            <a href="{{ route('denda.edit', $item->id_denda) }}"
                                class="btn btn-warning btn-sm text-white">Edit</a>
                            <form action="{{ route('denda.destroy', $item->id_denda) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
