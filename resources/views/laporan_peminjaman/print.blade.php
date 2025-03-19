<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Peminjaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            text-align: center;
        }
        .header img {
            width: 80px;
            height: auto;
        }
        .header h2 {
            margin: 0;
            flex-grow: 1;
            text-align: center;
        }
        .date-container {
            font-weight: bold;
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
        <h2>Laporan Peminjaman Buku</h2>
        <div class="date-container">{{ date('d F Y') }}</div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $index => $pinjam)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pinjam->anggota->nama_anggota }}</td>
                <td>{{ $pinjam->buku->judul }}</td>
                <td>{{ $pinjam->tgl_pinjam }}</td>
                <td>{{ $pinjam->tgl_kembali }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <button class="btn-print" onclick="window.print()">Print</button>
</body>
</html>
