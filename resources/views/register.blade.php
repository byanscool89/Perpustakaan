<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SMP Negeri 3 Karanglewas</title>
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        @keyframes flip {
            0% { transform: scaleX(-1); }
            100% { transform: scaleX(1); }
        }
        body {
            background-color: #f0f4f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            color: white;
            text-align: center;
        }
        .btn-primary {
            background-color: #1A1A2E;
            border-color: #1A1A2E;
        }
        .btn-primary:hover {
            background-color: #2c2c34;
            border-color: #2c2c34;
        }
        a {
            color: #00796b;
        }
        a:hover {
            opacity: 60%;
        }
        img {
            animation: flip 4s infinite alternate;
        }
    </style>
</head>
<body
    style="background-image: url('{{ asset('bg-login.jpeg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
            overflow-x: hidden;">
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-center ">
                        <img src="{{ asset('logo.png') }}" alt="" class="w-25">
                    </div>
                    <h1 class="card-title text-black">Register</h1>
                </div>
                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nama Anda" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="xxx@gmail.com" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password Anda" required>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                        <div class="text-center mt-3">
                            <p>Sudah punya akun? <a href="{{ route('login') }}">Klik di sini</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
</body>
</html>
