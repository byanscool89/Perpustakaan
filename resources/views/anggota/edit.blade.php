@extends('layout.main')
@section('title', 'Edit Anggota')

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">Edit Anggota</h1>
    <form action="{{ route('anggota.update', $anggota->id_anggota) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_anggota" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" value="{{ $anggota->nama_anggota }}" required>
        </div>
        <div class="mb-3">
            <label for="jk_kelamin" class="form-label">Jenis Kelamin</label>
            <select class="form-select" id="jk_kelamin" name="jk_kelamin" required>
                <option value="Laki-Laki" {{ $anggota->jk_kelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                <option value="Perempuan" {{ $anggota->jk_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="alamat_anggota" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat_anggota" name="alamat_anggota" value="{{ $anggota->alamat_anggota }}">
        </div>
        <div class="mb-3">
            <label for="no_telp" class="form-label">No Telp</label>
            <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ $anggota->no_telp }}">
        </div>
        <div class="mb-3">
            <label for="status_anggota" class="form-label">Status</label>
            <select class="form-select" id="status_anggota" name="status_anggota" required>
                <option value="siswa" {{ $anggota->status_anggota == 'siswa' ? 'selected' : '' }}>Siswa</option>
                <option value="karyawan" {{ $anggota->status_anggota == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
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
