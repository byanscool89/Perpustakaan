<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
        <a href="{{ route('home') }}" class="logo d-flex gap-2 align-items-center">
          <img
            src="{{ asset('logo.png') }}"
            alt="navbar brand"
            class="navbar-brand object-fit-cover"
            height="40"
            width="40"
          />
          <h4 class="text-white m-0">SIP</h4>
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
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
        <ul class="nav nav-secondary">
          <li class="nav-item active" style="margin-bottom: 25px;">
            <a href="{{ route('home') }}">
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item active" style="margin-bottom: 25px;">
            <a href="{{ route('buku.create') }}">
              <p>Buku</p>
            </a>
          </li>

          <li class="nav-item active" style="margin-bottom: 25px;">
            <a href="{{ route('peminjaman.create') }}">
              <p>Peminjaman</p>
            </a>
          </li>

          <li class="nav-item active" style="margin-bottom: 25px;">
            <a href="">
              <p>Pengembalian</p>
            </a>
          </li>

          <li class="nav-item active" style="margin-bottom: 25px;">
            <a href="{{ route('anggota.create') }}">
              <p>Anggota</p>
            </a>
          </li>

          <li class="nav-item active" style="margin-bottom: 25px;">
            <a data-bs-toggle="collapse" href="#laporanMenu">
              <p>Laporan</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="laporanMenu">
              <ul class="nav nav-collapse">
                <li style="margin-bottom: 10px;">
                  <a href="#">
                    <span class="sub-item">Peminjaman</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span class="sub-item">Pengembalian</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item active">
            <a data-bs-toggle="collapse" href="#editMenu">
              <p>Edit</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="editMenu">
              <ul class="nav nav-collapse">
                <li style="margin-bottom: 10px;">
                  <a href="{{ route('kategori.create') }}">
                    <span class="sub-item">Kategori</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span class="sub-item">Rak</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>

        </ul>
      </div>
    </div>
  </div>
