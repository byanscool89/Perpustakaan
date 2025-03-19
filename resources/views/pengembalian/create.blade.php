@extends('layout.main')

@section('content')
    <div class="container">
        <h1>Tambah Data Pengembalian</h1>
        <div class="d-flex justify-content-end">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#scanModal">
                Scan QR Code
            </button>
        </div>

        <form action="{{ route('pengembalian.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="id_peminjaman" class="form-label">Peminjaman</label>
                <select class="form-select" id="id_peminjaman" name="id_peminjaman" required>
                    @foreach ($peminjaman as $item)
                        <option value="{{ $item->id_peminjaman }}">{{ $item->id_peminjaman }} -
                            {{ $item->anggota->nama_anggota }} - {{ $item->buku->judul }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="id_denda" class="form-label">Denda</label>
                <select class="form-select" id="id_denda" name="id_denda" required>
                    <option value="" selected disabled>Pilih Denda</option> <!-- Pilihan default -->
                    @foreach ($denda as $item)
                        <option value="{{ $item->id_denda }}">{{ $item->kategori_denda }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3">
                <label for="tgl_dikembalikan" class="form-label">Tanggal Dikembalikan</label>
                <input type="date" name="tgl_dikembalikan" id="tgl_dikembalikan" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <!-- Modal untuk Scan QR Code -->
    <div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Scan QR Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="qr-reader" style="width: 100%;"></div>
                    <p id="qr-result" class="mt-3 text-center"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan Library QR Code -->
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const html5QrCode = new Html5Qrcode("qr-reader");

            function onScanSuccess(decodedText) {
                document.getElementById("id_peminjaman").value = decodedText;
                document.getElementById("qr-result").innerText = "QR Code: " + decodedText;

                // Hentikan scanning setelah berhasil
                html5QrCode.stop().then(() => {
                    var scanModal = new bootstrap.Modal(document.getElementById('scanModal'));
                    scanModal.hide();
                }).catch(err => console.log("Gagal menghentikan kamera", err));
            }

            let isScanning = false;

            document.getElementById("scanModal").addEventListener("shown.bs.modal", function () {
                if (!isScanning) {
                    isScanning = true;
                    html5QrCode.start({ facingMode: "environment" }, { fps: 10, qrbox: 250 }, onScanSuccess)
                    .catch(err => console.log("Gagal membuka kamera: " + err));
                }
            });

            document.getElementById("scanModal").addEventListener("hidden.bs.modal", function () {
                if (isScanning) {
                    html5QrCode.stop().then(() => isScanning = false)
                    .catch(err => console.log("Gagal menghentikan kamera", err));
                }
            });
        });
    </script>
@endsection
