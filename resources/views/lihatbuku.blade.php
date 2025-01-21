<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Arial', sans-serif;
        }

        /* Navbar */
        .navbar {
            border-bottom: 3px solid #007bff;
        }

        .navbar-brand {
            font-size: 1.5rem;
            text-transform: uppercase;
        }

        .navbar-nav .nav-link {
            color: #ffffff !important;
            transition: background 0.3s, color 0.3s;
        }

        .navbar-nav .nav-link:hover {
            background-color: #007bff;
            color: #ffffff !important;
            border-radius: 5px;
        }

        .nav-link.btn {
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        /* Header */
        h2 {
            font-weight: bold;
            color: #343a40;
            border-bottom: 3px solid #007bff;
            display: inline-block;
            padding-bottom: 8px;
        }

        /* Table */
        .table {
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
        }

        .table th {
            background: #343a40 !important;
            color: #fff;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 1px;
            padding: 12px;
        }

        .table td {
            font-size: 14px;
            color: #333;
            padding: 10px;
        }

        .table-hover tbody tr:hover {
            background-color: #f0f8ff;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-responsive {
            background: #ffffff;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        /* Add space between navbar and content */
        .container {
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">SMP Negeri 3 Karanglewas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light px-4 py-2" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Daftar Buku</h2>
        <div class="table-responsive shadow-lg p-4 bg-body rounded">
            <table class="table table-striped table-hover table-bordered align-middle">
                <thead class="table-dark text-center">
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bukus as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->isbn }}</td>
                        <td>{{ $item->penulis }}</td>
                        <td>{{ $item->penerbit }}</td>
                        <td class="text-center">{{ $item->tahun_terbit }}</td>
                        <td class="text-center">{{ $item->stok }}</td>
                        <td>{{ $item->nama_kategori }}</td>
                        <td>{{ $item->nama_rak }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
