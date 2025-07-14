@extends('layout.main') <!-- Sesuaikan dengan layout Anda -->

@section('content')
<div class="container">
    <h1>Edit Data Pengembalian</h1>

    <form action="{{ route('pengembalian.update', $pengembalian->id_pengembalian) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="id_pengembalian" class="form-label">ID Pengembalian</label>
            <input type="text" name="id_pengembalian" id="id_pengembalian" class="form-control" value="{{ $pengembalian->id_pengembalian }}" readonly>
        </div>
        <div class="mb-3">
            <label for="id_peminjaman" class="form-label">ID Peminjaman</label>
            <input type="text" name="id_peminjaman" id="id_peminjaman" class="form-control" value="{{ $pengembalian->id_peminjaman }}" required>
        </div>
        <div class="mb-3">
            <label for="id_denda" class="form-label">Kategori Denda</label>
            <select class="form-control" id="id_denda" name="id_denda" required>
                <option value="">-- Pilih Kategori Denda --</option>
                @foreach($denda as $item)
                    <option value="{{ $item->id_denda }}" 
                        {{ $item->id_denda == $pengembalian->id_denda ? 'selected' : '' }}>
                        {{ $item->kategori_denda }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="id_petugas" class="form-label">ID Petugas</label>
            <input type="text" name="id_petugas" id="id_petugas" class="form-control" value="{{ $pengembalian->id_petugas }}" readonly>
        </div>
        <div class="mb-3">
            <label for="tgl_dikembalikan" class="form-label">Tanggal Dikembalikan</label>
            <input type="date" name="tgl_dikembalikan" id="tgl_dikembalikan" class="form-control" value="{{ $pengembalian->tgl_dikembalikan }}">
        </div>
        <div class="mb-3">
            <label for="biaya_denda" class="form-label">Biaya Denda</label>
            <input type="number" step="0.01" name="biaya_denda" id="biaya_denda" class="form-control" value="{{ $pengembalian->biaya_denda }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
