@extends('layout.main')
@section('title', 'Tambah Peminjaman')

@section('content')
 
    <div class="container mt-4">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('peminjaman.index') }}" class="btn btn-primary">Daftar Peminjaman</a>
        </div>
        <h1 class="mb-3">Tambah Peminjaman Baru</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf
            @method('POST')
            {{-- <div class="mb-3">
            <label for="id_peminjaman" class="form-label">ID Peminjaman</label>
            <input type="text" class="form-control" id="id_peminjaman" name="id_peminjaman"  required>
        </div> --}}
            {{-- <input type="text" name="id_petugas" value="{{ auth()->user()->id_petugas }}"> --}}
            <div class="mb-3">
                <label for="tgl_pinjam" class="form-label">Tanggal Pinjam</label>
                <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" required>
            </div>
            <div class="mb-3">
                <label for="tgl_kembali" class="form-label">Tanggal Kembali</label>
                <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" required>
            </div>
            {{-- <div class="mb-3">
                <label for="id_anggota" class="form-label">Nama Anggota</label>
                <select class="form-select" id="id_anggota" name="id_anggota" required>
                    <option value="" selected disabled>Pilih Anggota</option>
                    @foreach ($anggota as $item)
                        <option value="{{ $item->id_anggota }}">{{ $item->nama_anggota }}</option>
                    @endforeach
                </select>
            </div> --}}

            <div class="mb-3">
                <label for="id_anggota" class="form-label">Nama Anggota</label>
                <select class="form-select" id="id_anggota" name="id_anggota" required>
                    @foreach ($anggota as $item)
                        <option value="{{ $item->id_anggota }}">{{ $item->nama_anggota }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="id_buku" class="form-label">Judul Buku</label>
                <select class="form-select" id="id_buku" name="id_buku" required>
                    @foreach ($buku as $item)
                        <option value="{{ $item->id_buku }}">{{ $item->judul }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const choices = new Choices('#id_anggota', {
                searchEnabled: true,
                placeholder: true,
                placeholderValue: 'Pilih Anggota',
                allowHTML: true,
                removeItemButton: true
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const choicesBuku = new Choices('#id_buku', {
                searchEnabled: true,
                placeholder: true,
                placeholderValue: 'Pilih Buku',
                allowHTML: true,
                removeItemButton: true
            });
        });
    </script>

@endsection
