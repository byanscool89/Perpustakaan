<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>SMP Negeri 3 Karanglewas</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="{{asset('petugas/assets/img/kaiadmin/favicon.ico')}}"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="{{asset('petugas/assets/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{asset('petugas/assets/css/fonts.min.css')}}"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('petugas/assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('petugas/assets/css/plugins.min.css')}}" />
    <link rel="stylesheet" href="{{asset('petugas/assets/css/kaiadmin.min.css')}}" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{asset('petugas/assets/css/demo.css')}}" />
  </head>
  <body>
    <div class="wrapper">
      @include('layout.sidebar')

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
              <a href="index.html" class="logo">
                <img
                  src="assets/img/kaiadmin/logo_light.svg"
                  alt="navbar brand"
                  class="navbar-brand"
                  height="20"
                />
              </a>
              <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
                </button>
              </div>
              <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
              </button>
            </div>
            <!-- End Logo Header -->
          </div>

          <!-- Navbar Header -->
          @include('layout.navbar')
        </div>

        <div class="container">
          <div class="page-inner">
            <div class="page-header">
              <ul class="breadcrumbs">
              </ul>
            </div>
            @yield('content')
          </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
          <div class="container-fluid d-flex justify-content-between">
            <nav class="nav">
              <!-- Tambahkan item navigasi jika diperlukan -->
            </nav>

            <div class="copyright">
              &copy; 2024, made by
              <a href="http://www.instagram.com/smpn3karanglewas" >SMP Negeri 3 Karanglewas</a>
            </div>
          </div>
        </footer>
        <!-- End Footer -->
      </div>
    </div>

    <!-- Core JS Files -->
    <script src="{{asset('petugas/assets/js/core/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('petugas/assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('petugas/assets/js/core/bootstrap.min.js')}}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{asset('petugas/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

    <!-- Chart JS -->
    <script src="{{asset('petugas/assets/js/plugin/chart.js/chart.min.js')}}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{asset('petugas/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Chart Circle -->
    <script src="{{asset('petugas/assets/js/plugin/chart-circle/circles.min.js')}}"></script>

    <!-- Datatables -->
    <script src="{{asset('petugas/assets/js/plugin/datatables/datatables.min.js')}}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{asset('petugas/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{asset('petugas/assets/js/plugin/jsvectormap/jsvectormap.min.js')}}"></script>
    <script src="{{asset('petugas/assets/js/plugin/jsvectormap/world.js')}}"></script>

    <!-- Google Maps Plugin -->
    <script src="{{asset('petugas/assets/js/plugin/gmaps/gmaps.js')}}"></script>

    <!-- Sweet Alert -->
    <script src="{{asset('petugas/assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{asset('petugas/assets/js/kaiadmin.min.js')}}"></script>
  </body>
</html>
