@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
  <div class="row">

    {{-- Tabel Produk Sudah Expired --}}
    <div class="col-lg-6 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <h6>Produk Sudah Expired</h6>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-bordered">
            <thead class="table-danger">
              <tr>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Tanggal Expired</th>
              </tr>
            </thead>
            <tbody>
              @forelse($expired as $item)
              <tr>
                <td>{{ $item->kode_produk }}</td>
                <td>{{ $item->nama_produk }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tgl_exp_terakhir)->format('d-m-Y') }}</td>
              </tr>
              @empty
              <tr>
                <td colspan="3" class="text-center">Tidak ada produk yang sudah expired.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{-- Tabel Produk Akan Expired --}}
    <div class="col-lg-12 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <h6>Produk Akan Expired (3 Minggu ke Depan)</h6>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-bordered">
            <thead class="table-warning">
              <tr>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Tanggal Expired</th>
              </tr>
            </thead>
            <tbody>
              @forelse($will_expired as $item)
              <tr>
                <td>{{ $item->kode_produk }}</td>
                <td>{{ $item->nama_produk }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tgl_exp_terakhir)->format('d-m-Y') }}</td>
              </tr>
              @empty
              <tr>
                <td colspan="3" class="text-center">Tidak ada produk yang akan expired dalam 3 minggu.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const expiredCtx = document.getElementById('expiredChart').getContext('2d');

  const expiredCount = {{ $expiredCount ?? 0 }};
  const willExpiredCount = {{ $willExpiredCount ?? 0 }};

  new Chart(expiredCtx, {
    type: 'bar',
    data: {
      labels: ['Sudah Expired', 'Akan Expired (3 Minggu ke Depan)'],
      datasets: [{
        label: 'Jumlah Produk',
        data: [expiredCount, willExpiredCount],
        backgroundColor: [
          'rgba(220, 53, 69, 0.7)', // Merah
          'rgba(255, 193, 7, 0.7)'  // Kuning
        ],
        borderColor: [
          'rgba(220, 53, 69, 1)',
          'rgba(255, 193, 7, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        title: {
          display: true,
          text: 'Statistik Produk Expired'
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            precision: 0,
            stepSize: 1
          }
        }
      }
    }
  });
});
</script>
@endsection
