<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - SMP Negeri 3 Karanglewas</title>
  <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #667eea, #764ba2);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .container {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .auth-form {
      background: white;
      padding: 30px 25px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      animation: fadeIn 0.6s ease-in-out;
      width: 100%;
      max-width: 400px;
    }

    .auth-form h2 {
      font-size: 24px;
      font-weight: 700;
      margin-bottom: 10px;
      color: #333;
    }

    .auth-form p {
      font-size: 14px;
      color: #666;
      margin-bottom: 25px;
    }

    .auth-form label {
      display: block;
      margin-bottom: 6px;
      font-size: 14px;
      color: #555;
    }

    .auth-form input {
      width: 100%;
      padding: 12px 14px;
      margin-bottom: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 14px;
      transition: border-color 0.3s ease;
    }

    .auth-form input:focus {
      border-color: #667eea;
      outline: none;
    }

    .auth-form button {
      width: 100%;
      background-color: #667eea;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .auth-form button:hover {
      background-color: #5a67d8;
    }

    .footer a {
      color: #667eea;
      text-decoration: none;
      font-weight: 500;
    }

    .footer a:hover {
      text-decoration: underline;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    footer {
      background-color: #ffffff;
      text-align: center;
      padding: 10px 0;
      font-size: 14px;
      color: #888;
      border-top: 1px solid #ddd;
    }
  </style>
</head>
<body style="background-image: url('{{ asset('1722.jpg') }}'); background-size: cover; background-position: center; background-attachment: fixed;">

  {{-- Navbar --}}
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


  {{-- Login Form --}}
  <div class="container">
    <form class="auth-form" action="{{ route('login') }}" method="POST">
      @csrf
      <h2>Welcome Back</h2>
      <p>Please login to your account</p>

      @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
      @endif

      <label for="email">Email</label>
      <input type="email" name="email" id="email" placeholder="you@example.com" required />

      <label for="password">Password</label>
      <input type="password" name="password" id="password" placeholder="........." required />

      <button type="submit">Login</button>

      <div class="footer mt-3">
        <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
      </div>
    </form>
  </div>

  {{-- SweetAlert2 --}}
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

  {{-- Footer --}}
  <footer>
<div class="container d-flex justify-content-end">
          <span class="text-muted">&copy; 2024, made by 
        <a href="https://instagram.com/smpn3karanglewas" target="_blank">SMP Negeri 3 Karanglewas</a>
      </span>
    </div>
  </footer>
</body>
</html>
