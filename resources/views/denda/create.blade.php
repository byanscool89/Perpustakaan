<!-- resources/views/denda/create.blade.php -->
@extends('layout.main')

@section('content')
<div class="container">
    <h1>Tambah Denda Baru</h1>
    <form action="{{ route('denda.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_denda" class="form-label">ID Denda</label>
            <input type="text" class="form-control" id="id_denda" name="id_denda" value="{{ old('id_denda') }}" required>
        </div>
        <div class="mb-3">
            <label for="kategori_denda" class="form-label">Kategori Denda</label>
            <input type="text" class="form-control" id="kategori_denda" name="kategori_denda" value="{{ old('kategori_denda') }}" required>
        </div>
        <div class="mb-3">
            <label for="biaya" class="form-label">Biaya</label>
            <input type="number" class="form-control" id="biaya" name="biaya" value="{{ old('biaya') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('denda.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@section('scripts')
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
@endsection
