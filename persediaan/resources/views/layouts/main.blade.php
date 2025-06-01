<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <title>Persediaan Produk CV Jaya Abadi</title>

  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">

  {{-- Fonts and icons --}}
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link id="pagestyle" href="{{ asset('css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />

  {{-- SweetAlert --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  {{-- Optional analytics --}}
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show bg-gray-100">
  {{-- SIDEBAR --}}
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-xl-none" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#">
        <span class="ms-1 font-weight-bold">Persediaan Produk CV Jaya Abadi</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        {{-- Dashboard --}}
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="fas fa-tachometer-alt me-2"></i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

        {{-- Admin Menu --}}
        @auth
          @if(Auth::user()->level == 'admin')
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}" href="{{ route('suppliers.index') }}">
                <i class="fas fa-truck me-2"></i> <span class="nav-link-text ms-1">Supplier</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('produks.*') ? 'active' : '' }}" href="{{ route('produks.index') }}">
                <i class="fa-solid fa-boxes-stacked me-2"></i> <span class="nav-link-text ms-1">Produk</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('produk-masuks.*') ? 'active' : '' }}" href="{{ route('produk-masuks.index') }}">
                <i class="fas fa-arrow-circle-down me-2"></i> <span class="nav-link-text ms-1">Produk Masuk</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('produk-keluars.*') ? 'active' : '' }}" href="{{ route('produk-keluars.index') }}">
                <i class="fas fa-arrow-circle-up me-2"></i> <span class="nav-link-text ms-1">Produk Keluar</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('stoks.index') ? 'active' : '' }}" href="{{ route('stoks.index') }}">
                <i class="fas fa-box me-2"></i>
                <span class="nav-link-text ms-1">Stok</span>
                @if(session('notif_count'))
                  <span class="badge bg-danger ms-auto">{{ session('notif_count') }}</span>
                @endif
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                <i class="fas fa-users-cog me-2"></i> <span class="nav-link-text ms-1">Manajemen Users</span>
              </a>
            </li>
          @endif
        @endauth

        {{-- Laporan --}}
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#laporanMenu" class="nav-link" aria-controls="laporanMenu" role="button" aria-expanded="false">
            <i class="fas fa-file-alt me-2"></i><span class="nav-link-text ms-1">Laporan</span>
          </a>
          <div class="collapse" id="laporanMenu">
            <ul class="nav ms-4 ps-2">
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('laporan.produkmasuk') ? 'active' : '' }}" href="{{ route('laporan.produkmasuk') }}">
                  <i class="fas fa-arrow-down me-2 text-sm"></i>Laporan Produk Masuk
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('laporan.produkkeluar') ? 'active' : '' }}" href="{{ route('laporan.produkkeluar') }}">
                  <i class="fas fa-arrow-up me-2 text-sm"></i>Laporan Produk Keluar
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('laporan.stok') ? 'active' : '' }}" href="{{ route('laporan.stok') }}">
                  <i class="fas fa-box me-2 text-sm"></i>Laporan Stok
                </a>
              </li>
            </ul>
          </div>
        </li>

        {{-- Logout --}}
        <li class="nav-item mt-3">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" class="nav-link text-danger" onclick="event.preventDefault(); this.closest('form').submit();">
              <i class="fas fa-sign-out-alt me-2 text-danger"></i><span class="fw-bold">Log Out</span>
            </a>
          </form>
        </li>
      </ul>
    </div>
  </aside>

  {{-- MAIN CONTENT --}}
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    {{-- Navbar --}}
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <!-- <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="#">Pages</a></li> -->
            <!-- <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li> -->
          </ol>
          <!-- <h6 class="font-weight-bolder mb-0">Dashboard</h6> -->
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
          <div class="px-2 pt-2">
            @auth
              <div class="card shadow-sm border-0 mb-2" style="background: linear-gradient(90deg, #5e72e4 0%, #825ee4 100%); color: #fff; max-width: 220px; margin: 0 auto;">
                <div class="card-body py-2 px-2 text-center">
                  <i class="fa fa-user-circle mb-1" style="font-size:1.3rem;"></i>
                  <div style="font-size:0.95rem; font-weight:600;">Welcome back,</div>
                  <div style="font-size:1.05rem; font-weight:bold;">{{ Auth::user()->name }}</div>
                </div>
              </div>
            @endauth
          </div>
        </div>
      </div>
    </nav>

    {{-- Content Area --}}
    <div class="container-fluid py-4">
      @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      @yield('content')
    </div>
  </main>
  
<style>
    .badge {
        font-size: 0.75rem;
        padding: 0.4em 0.6em;
    }
</style>

  {{-- Scripts --}}
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
  <script src="{{ asset('js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>
</body>
</html>
