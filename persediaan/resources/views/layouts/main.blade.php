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

  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link id="pagestyle" href="{{ asset('css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />

  <!-- SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Optional analytics -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
  
    <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.css">

</head>


<body class="g-sidenav-show bg-gray-100">
  <!-- Sidenav -->
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-xl-none" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#">
      <div class="text-center">
          <span class="d-block font-weight-bold">Persediaan Produk</span>
          <span class="d-block font-weight-bold">CV Jaya Abadi</span>
      </div>
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

        <!-- Admin Menu -->
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

        <!-- Laporan -->
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

        <!-- Logout -->
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

  <!-- MAIN CONTENT -->
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          </ol>
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

    <div class="container-fluid py-4">
      @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

  <!-- tampilkan hanya di dashboard -->
  @if(request()->routeIs('dashboard') && isset($labels, $stokData, $produkMasukData, $produkKeluarData))
    <div class="card mb-4">
      <div class="card-header pb-0">
        <h6>Grafik Persediaan Produk</h6>
      </div>
      <div class="card-body">
        <canvas id="produkChart" height="100"></canvas>
      </div>
    </div>
  @endif

  @yield('content')

<!-- menampilkan grafik -->
@isset($labels, $stokData, $produkMasukData, $produkKeluarData)
<script>
    const labels = {!! json_encode($labels) !!};
    const stokData = {!! json_encode($stokData->values()) !!};
    const produkMasukData = {!! json_encode($produkMasukData->values()) !!};
    const produkKeluarData = {!! json_encode($produkKeluarData->values()) !!};

    document.addEventListener("DOMContentLoaded", () => {
      const ctx = document.getElementById("produkChart")?.getContext("2d");
      if (ctx) {
        new Chart(ctx, {
          type: 'line',
          data: {
            labels: labels,
            datasets: [
              {
                label: 'Stok',
                data: stokData,
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                fill: true
              },
              {
                label: 'Produk Masuk',
                data: produkMasukData,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true
              },
              {
                label: 'Produk Keluar',
                data: produkKeluarData,
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                fill: true
              }
            ]
          },
          options: {
            responsive: true,
            plugins: {
              legend: { position: 'top' },
              title: {
                display: true,
                text: 'Grafik Stok Produk'
              }
            }
          }
        });
      }
    });
</script>
@endisset

<!-- Setting bg gambar -->
  <style>
    .badge {
      font-size: 0.75rem;
      padding: 0.4em 0.6em;
    }
    #bg-header-strip {
    background-image: url("{{ asset('img/bg.jpg') }}");
    background-size: cover;
    background-position: center;
    height: 60px;
    width: 100%;
    border-radius: 12px;
    margin-bottom: 20px;
  }
  </style>

  <!-- Scripts -->
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="{{ asset('js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>

  @yield('scripts')

  <!-- DataTables Scripts -->
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.dataTables.js"></script>


  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const table = document.querySelector('#example');
      if (table) {
        new DataTable('#example', {
          scrollX: true
          // responsive: true
        });
      }
    });
  </script>

<!-- tampilan -->
<style>
    body {
      background-image: url('{{ asset('img/bg.jpg') }}');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      position: relative;
      z-index: 1;
      font-family: 'Open Sans', sans-serif;
    }

    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      z-index: -1;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(2px);
    }

    .main-content,
    .main-content p,
    .card-body,
    .container-fluid,
    .content,
    .alert,
    .navbar .card {
      text-align: justify;
      line-height: 1.6;
    }

    .main-content {
      background-color: rgba(255, 255, 255, 0.96);
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
      margin-top: 20px;
      padding: 20px;
    }

    .navbar {
      background-color: white !important;
      color: #333 !important;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .navbar .card {
      background-color: #f8f9fa !important;
      color: #333;
    }

    .sidenav {
      background-color: #ffffffee;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      backdrop-filter: blur(6px);
    }

    .nav-link {
      color: #333;
      font-weight: 500;
    }

    .nav-link.active {
      background-color: #f1f1f1 !important;
      color: #000 !important;
      font-weight: bold;
      border-radius: 8px;
    }

    .nav-link:hover {
      background-color: #e9ecef;
      border-radius: 8px;
    }

    .card {
      background-color: white;
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.04);
    }

    .alert-success {
      background-color: #d4edda;
      border-color: #c3e6cb;
      color: #155724;
      font-weight: 600;
    }

    .badge {
      font-size: 0.75rem;
      padding: 0.4em 0.6em;
    }
  </style>
</body>
</html>
