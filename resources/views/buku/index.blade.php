@extends('layout.main')
@section('title', 'Daftar Buku')

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Daftar Buku</h1>
            <div>
                <a href="{{ route('buku.create') }}" class="btn btn-secondary">
                    Tambah Buku
                </a>
            </div>
        </div>

        <form action="{{ route('buku.search') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" name="keyword" class="form-control" placeholder="Cari buku..."
                    value="{{ request('keyword') }}">
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
        </form>

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>ISBN</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Stok Buku</th>
                <th>Kategori</th>
                <th>Rak</th>
                <th>Action</th>
            </tr>

            @foreach ($buku as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->isbn }}</td>
                    <td>{{ $item->penulis }}</td>
                    <td>{{ $item->penerbit }}</td>
                    <td>{{ $item->tahun_terbit }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>{{ $item->kategori->nama_kategori }}</td>
                    <td>{{ $item->rak->nama_rak }}</td>
                    <td>
                        <div class="d-flex justify-content-evenly gap-2">
                            <a href="{{ route('buku.edit', $item->id_buku) }}"
                                class="btn btn-warning btn-sm text-white">Edit</a>
                            <form action="{{ route('buku.destroy', $item->id_buku) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <!-- Modal untuk Scan QR Code -->
    <div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scanModalLabel">Scan QR Code Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <video id="preview" style="width: 100%;"></video>
                    <form action="{{ route('buku.store') }}" method="POST">
                        @csrf
                        <input type="text" name="isbn" id="isbn" class="form-control mt-2"
                            placeholder="ISBN Buku" readonly required>
                        <button type="submit" class="btn btn-primary mt-2">Tambah Buku</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan Library Instascan -->
    <!-- Tambahkan Library Instascan -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/instascan/1.0.0/instascan.min.js"></script>

    {{-- <script>
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

    scanner.addListener('scan', function (content) {
        document.getElementById('isbn').value = content;
    });

    document.addEventListener('DOMContentLoaded', function () {
        let scanModal = document.getElementById('scanModal');

        scanModal.addEventListener('shown.bs.modal', function () {
            Instascan.Camera.getCameras().then(function (cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[1]); // Gunakan kamera kedua (jika ada lebih dari satu)
                } else {
                    alert("Kamera tidak ditemukan! Pastikan izin kamera diberikan.");
                }
            }).catch(function (e) {
                console.error(e);
            });
        });

        scanModal.addEventListener('hidden.bs.modal', function () {
            scanner.stop();
        });
    });
</script> --}}
@endsection
