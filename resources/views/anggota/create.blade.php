@extends('layout.main')
@section('title', 'Tambah Anggota')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('anggota.index') }}" class="btn btn-primary">Daftar Anggota</a>
        </div>

        <h1 class="mb-3">Tambah Anggota Baru</h1>
        <form action="{{ route('anggota.store') }}" method="POST">
            @csrf
            {{-- <div class="mb-3">
                <label for="id_anggota" class="form-label">ID Anggota</label>
                <input type="text" class="form-control" id="id_anggota" name="id_anggota" required>
            </div> --}}
            <div class="mb-3">
                <label for="nama_anggota" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" required>
                @error('nama_anggota')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jk_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jk_kelamin" name="jk_kelamin" required>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="alamat_anggota" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat_anggota" name="alamat_anggota">
            </div>
            <div class="mb-3">
                <label for="no_telp" class="form-label">No Telp</label>
                <input type="text" class="form-control" id="no_telp" name="no_telp">
            </div>
            <div class="mb-3">
                <label for="status_anggota" class="form-label">Status</label>
                <select class="form-select" id="status_anggota" name="status_anggota" required>
                    <option value="siswa">Siswa</option>
                    <option value="karyawan">Karyawan</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
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
