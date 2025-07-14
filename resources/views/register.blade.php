<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register - SMP Negeri 3 Karanglewas</title>

  <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      height: 100%;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-image: url('{{ asset('bg-login.jpeg') }}');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      display: flex;
      flex-direction: column;
    }

    main {
      flex: 1;
      display: flex;
      justify-content: flex-start; /* posisikan ke kiri */
      align-items: center;
      padding: 40px;
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

    .footer {
      margin-top: 20px;
      text-align: center;
      font-size: 14px;
      color: #888;
    }

    .footer a {
      color: #667eea;
      text-decoration: none;
      font-weight: 500;
    }

    .footer a:hover {
      text-decoration: underline;
    }

    footer {
      background-color: #ffffff;
      text-align: center;
      padding: 10px 0;
      font-size: 14px;
      color: #888;
      border-top: 1px solid #ddd;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

  {{-- Navbar --}}
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <img src="{{ asset('logo.png') }}" alt="Logo" style="width: 50px; height: auto; margin-right:10px;">
      <span class="navbar-brand mb-0 h1">SMP Negeri 3 Karanglewas</span>
    </div>
  </nav>

  <main>
    <form class="auth-form" action="{{ route('register') }}" method="POST">
      @csrf
      <h2>Create Account</h2>
      <p>Join us and start your journey</p>

      @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
      @endif

      <label for="name">Full Name</label>
      <input type="text" name="name" id="name" placeholder="Your Name" required />
      @error('name')
        <div class="text-danger" style="font-size: 14px;">{{ $message }}</div>
      @enderror

      <label for="email">Email</label>
      <input type="email" name="email" id="email" placeholder="you@example.com" required />
      @error('email')
        <div class="text-danger" style="font-size: 14px;">{{ $message }}</div>
      @enderror

      <label for="password">Password</label>
      <input type="password" name="password" id="password" placeholder="........." required />
      @error('password')
        <div class="text-danger" style="font-size: 14px;">{{ $message }}</div>
      @enderror

      <button type="submit">Register</button>

      <div class="footer">
        <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
      </div>
    </form>
  </main>

  {{-- SweetAlert2 --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @if (Session::has('error'))
    <script>
      Swal.fire({
        icon: "error",
        title: "Terjadi Kesalahan...",
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

  {{-- Footer --}}
  <footer>
    <div class="container d-flex justify-content-end">
      <span class="text-muted">
        &copy; 2024, made by 
        <a href="https://instagram.com/smpn3karanglewas" target="_blank">SMP Negeri 3 Karanglewas</a>
      </span>
    </div>
  </footer>
</body>
</html>
