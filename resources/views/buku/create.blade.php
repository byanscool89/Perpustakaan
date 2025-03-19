@extends('layout.main')
@section('title', 'create')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('buku.index') }}" class="btn btn-primary">Daftar Buku</a>
    </div>
    <h1 class="mb-3">Tambah Buku Baru</h1>
    <form action="{{ route('buku.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="judul" class="form-label">Judul Buku</label>
            <input type="text" class="form-control" id="judul" name="judul" required>
        </div>
        <div class="mb-3">
            <label for="isbn" class="form-label">No ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" required>
        </div>
        <div class="mb-3">
            <label for="penulis" class="form-label">Nama Penulis</label>
            <input type="text" class="form-control" id="penulis" name="penulis" required>
        </div>
        <div class="mb-3">
            <label for="penerbit" class="form-label">Nama Penerbit</label>
            <input type="text" class="form-control" id="penerbit" name="penerbit" required>
        </div>
        <div class="mb-3">
            <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
            <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" required>
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" required>
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">Pilih Kategori</label>
            <select class="form-select" id="id_kategori" name="id_kategori" required>
                <option value="" selected disabled>Pilih Kategori</option>
                @foreach ($optionKategori as $kategori)
                    <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="rak" class="form-label">Pilih Rak</label>
            <select class="form-select" id="id_rak" name="id_rak" required>
                <option value="" selected disabled>Pilih Rak</option>
                @foreach ($optionRak as $rak)
                <option value="{{ $rak->id_rak }}">{{ $rak->nama_rak }}</option>
            @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (Session::has('error'))
<script>
Swal.fire({
    icon: "error",
    title: "Terjadi Kesalahan....",
    text: "{{ Session::get('error') }}",
});
</script>
@endif
@if (Session::has('success'))
<script>
Swal.fire({
    icon: "success",
    title: "Berhasil",
    text: "{{ Session::get('success') }}",
});
</script>
@endif
