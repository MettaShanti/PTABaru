@extends('layouts.main')

@section('content')
<div class="container-fluid min-vh-100">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <h2 class="mb-0">Data Stok</h2>

        <!-- Tombol Produk Expired -->
        <button type="button" class="btn btn-warning position-relative mt-2 mt-md-0" data-bs-toggle="modal" data-bs-target="#modalExpired">
            <i class="fas fa-exclamation-triangle me-1"></i> Produk Expired
            @if(session('notif_count', 0) > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ session('notif_count') }}
            </span>
            @endif
        </button>
    </div>

    <!-- Filter Tanggal Exp -->
    <form action="{{ route('stoks.index') }}" method="GET" class="row g-3 align-items-center mb-4">
        <div class="col-md-3">
            <label for="from" class="form-label">Dari Tanggal Exp</label>
            <input type="date" name="from" id="from" class="form-control" value="{{ request('from') }}">
        </div>
        <div class="col-md-3">
            <label for="to" class="form-label">Sampai Tanggal Exp</label>
            <input type="date" name="to" id="to" class="form-control" value="{{ request('to') }}">
        </div>
        <div class="col-md-auto mt-md-4">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('stoks.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <!-- Tabel Stok -->
    <div class="table-responsive">
        <table id="example" class="table table-bordered table-hover table-sm align-middle text-nowrap w-100">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Jenis</th>
                    <th>Satuan</th>
                    <th>Total Masuk</th>
                    <th>Total Keluar</th>
                    <th>Stok Akhir</th>
                    <th>Tgl Produksi Terakhir</th>
                    <th>Tgl Exp Terakhir</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stoks as $stok)
                    @php
                        $exp = \Carbon\Carbon::parse($stok->tgl_exp_terakhir);
                        $today = now();
                        $rowClass = '';

                        if ($exp->lt($today)) {
                            $rowClass = 'table-danger';
                        } elseif ($exp->lte($today->copy()->addDays(21))) {
                            $rowClass = 'table-warning';
                        }
                    @endphp
                    <tr class="{{ $rowClass }}">
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $stok->kode_produk }}</td>
                        <td>{{ $stok->nama_produk }}</td>
                        <td>{{ $stok->jenis }}</td>
                        <td>{{ $stok->satuan }}</td>
                        <td class="text-end">{{ $stok->total_masuk }}</td>
                        <td class="text-end">{{ $stok->total_keluar }}</td>
                        <td class="text-end fw-bold">{{ $stok->stok_akhir }}</td>
                        <td>{{ $stok->tgl_produksi_terakhir }}</td>
                        <td>{{ $stok->tgl_exp_terakhir }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">Tidak ada data stok tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Produk Expired -->
    <div class="modal fade" id="modalExpired" tabindex="-1" aria-labelledby="modalExpiredLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalExpiredLabel">Informasi Produk Expired</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h5>Sudah Expired</h5>
            <table class="table table-bordered table-sm text-nowrap">
              <thead class="table-danger">
                <tr>
                  <th>Kode Produk</th>
                  <th>Nama Produk</th>
                  <th>Stok Akhir</th>
                  <th>Tanggal Expired</th>
                </tr>
              </thead>
              <tbody>
                @forelse($expired as $stok)
                <tr>
                  <td>{{ $stok->kode_produk }}</td>
                  <td>{{ $stok->nama_produk }}</td>
                  <td>{{ $stok->stok_akhir }}</td>
                  <td>{{ $stok->tgl_exp_terakhir }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="4" class="text-center">Tidak ada produk yang sudah expired.</td>
                </tr>
                @endforelse
              </tbody>
            </table>

            <h5 class="mt-4">Akan Expired (dalam 3 minggu ke depan)</h5>
            <table class="table table-bordered table-sm text-nowrap">
              <thead class="table-warning">
                <tr>
                  <th>Kode Produk</th>
                  <th>Nama Produk</th>
                  <th>Stok Akhir</th>
                  <th>Tanggal Expired</th>
                </tr>
              </thead>
              <tbody>
                @forelse($will_expired as $stok)
                <tr>
                  <td>{{ $stok->kode_produk }}</td>
                  <td>{{ $stok->nama_produk }}</td>
                  <td>{{ $stok->stok_akhir }}</td>
                  <td>{{ $stok->tgl_exp_terakhir }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="4" class="text-center">Tidak ada produk yang akan expired dalam 3 minggu.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
