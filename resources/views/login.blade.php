<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SMP Negeri 3 Karanglewas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #1A1A2E;
            border-color: #1A1A2E;
        }

        .btn-primary:hover {
            background-color: #223d52;
            border-radius: 5px;
        }

        .flip-logo {
            animation: flip 4s infinite alternate;
            transform-origin: center;
        }

        @keyframes flip {
            0% {
                transform: rotateY(180deg);
            }

            100% {
                transform: rotateY(0deg);
            }
        }
    </style>
</head>

<body style="background-image: url('{{ asset('bg-login.jpeg') }}'); background-size: cover; background-position: center; height: 100vh; overflow-x: hidden;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <img src="{{ asset('logo.png') }}" alt="Logo Instansi" style="width: 50px; height: auto; margin-right:10px">

            <a class="navbar-brand" href="#">SMP Negeri 3 Karanglewas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('bukus.lihatbuku') }}">Menu</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-lg-4">
            <div class="card mt-2">
                <div class="card-header text-center">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="w-25 flip-logo">
                    <h1 class="card-title text-black text-center">LOGIN</h1>
                </div>
                <div class="card-body">
                    @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="xxx@gmail.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Your Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (Session::has('error'))
        <script>
            Swal.fire({ icon: "error", title: "Oops...", text: "{{ Session::get('error') }}" });
        </script>
    @endif
    @if (Session::has('success'))
        <script>
            Swal.fire({ icon: "success", title: "Berhasil", text: "{{ Session::get('success') }}" });
        </script>
    @endif
</body>

</html>
