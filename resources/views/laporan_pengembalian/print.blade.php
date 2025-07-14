<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Pengembalian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            text-align: center;
        }
        .header img {
            width: 80px;
            height: auto;
            margin-right: 15px;
        }
        .header h2 {
            margin: 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .btn-print {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }
        .btn-print:hover {
            background-color: #218838;
        }
        @media print {
            .btn-print, .filter-container {
                display: none;
            }
        }
        .filter-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .filter-container label {
            font-weight: bold;
        }
        .filter-container input {
            padding: 8px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
        .filter-container button {
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .filter-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
 

    <div class="header">
        <img src="{{ asset('logo.png') }}" alt="Logo Instansi">
        <div class="header">
            <img src="{{ asset('logo.png') }}" alt="Logo Instansi">
            <h2>PEMERINTAH KABUPATEN BANYUMAS</h2>
            <h3>LAPORAN PEMINJAMAN</h3>
            <h1>SMP NEGERI 3 KARANGLEWAS</h1>
            <p>NPSN 20348594</p>
            <p>Jalan Raya Kejubug, RT.1/RW.5, Dusun III, Sunyalangu, Kec. Karanglewas, Kabupaten Banyumas, Jawa Tengah 53161</p>
            <p><strong>{{ date('d F Y') }}</strong></p>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Tanggal Kembali</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengembalian as $index => $kembali)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $kembali->anggota->nama_anggota }}</td>
                <td>{{ $kembali->buku->judul }}</td>
                <td>{{ $kembali->tgl_kembali }}</td>
                <td>{{ $kembali->denda ? 'Rp. ' . number_format($kembali->denda, 0, ',', '.') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <button class="btn-print" onclick="window.print()">Print</button>
</body>
</html>
