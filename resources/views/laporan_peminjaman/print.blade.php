<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            text-align: center;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid black;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header img {
            width: 80px;
            height: auto;
            position: absolute;
            left: 50px;
            top: 10px;
        }
        .header h1, .header h2, .header p {
            margin: 5px 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid black;
            padding: 8px;
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
            .btn-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('logo.png') }}" alt="Logo Instansi">
        <h2>PEMERINTAH KABUPATEN BANYUMAS</h2>
        <h3>LAPORAN PENGEMBALIAN</h3>
        <h1>SMP NEGERI 3 KARANGLEWAS</h1>
        <p>NPSN 20348594</p>
        <p>Jalan Raya Kejubug, RT.1/RW.5, Dusun III, Sunyalangu, Kec. Karanglewas, Kabupaten Banyumas, Jawa Tengah 53161</p>
        <p><strong>{{ date('d F Y') }}</strong></p>
    </div>

    <h2>Laporan Peminjaman Buku</h2>
    
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
