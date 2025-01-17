@extends('layout.main') <!-- Sesuaikan dengan layout Anda -->

@section('content')
<div class="container">
    <h1>Tambah Data Pengembalian</h1>

    <form
    action="{{ route('pengembalian.store') }}" method="POST"
    >
        @csrf
        {{-- <div class="mb-3">
            <label for="id_pengembalian" class="form-label">ID Pengembalian</label>
            <input type="text" name="id_pengembalian" id="id_pengembalian" class="form-control" required>
        </div> --}}
        {{-- <div class="mb-3">
            <label for="id_peminjaman" class="form-label">ID Peminjaman</label>
            <input type="text" name="id_peminjaman" id="id_peminjaman" class="form-control" required>
        </div> --}}
        <div class="mb-3">
            <label for="id_peminjaman" class="form-label">Peminjaman</label>
            <select class="form-select" id="id_peminjaman" name="id_peminjaman" required>
                <option value="" selected disabled>Pilih ID Peminjaman</option>
                @foreach ($peminjaman as $item)
                    <option value="{{ $item->id_peminjaman }}">{{ $item->id_peminjaman }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="id_denda" class="form-label">Denda</label>
            <select class="form-select" id="id_denda" name="id_denda" required>
                <option value="" selected disabled>Pilih Denda</option>
                @foreach ($denda as $item)
                    <option value="{{ $item->id_denda }}">{{ $item->kategori_denda }}</option>
                @endforeach
            </select>
        </div>

        {{-- <div class="mb-3">
            <label for="id_petugas" class="form-label">ID Petugas</label>
            <input type="text" name="id_petugas" id="id_petugas" class="form-control" required>
        </div> --}}
        {{-- <input type="hidden" value="{{ Auth::user()->id_petugas }}"> --}}
        <div class="mb-3">
            <label for="tgl_dikembalikan" class="form-label">Tanggal Dikembalikan</label>
            <input type="date" name="tgl_dikembalikan" id="tgl_dikembalikan" class="form-control">
        </div>
        {{-- <div class="mb-3">
            <label for="biaya_denda" class="form-label">Biaya Denda</label>
            <input type="number" step="0.01" name="biaya_denda" id="biaya_denda" class="form-control" required>
        </div> --}}
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
