@extends('layouts.main')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Laporan Produk Masuk</h5>
    </div>
    <div class="card-body">
        <form method="GET" class="row g-3 mb-4">
            <div class="col-md-3">
                <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                <input type="date" id="tanggal_awal" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
            </div>
            <div class="col-md-3">
                <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
            </div>
            <div class="col-md-4">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" id="nama_produk" name="nama_produk" class="form-control" value="{{ request('nama_produk') }}" placeholder="Cari Nama Produk">
            </div>
            <div class="col-md-2 d-flex align-items-end gap-2">
                <button class="btn btn-primary w-50" type="submit">Filter</button>
                <a href="{{ route('laporan.produk-masuk.cetak', request()->all()) }}" target="_blank" class="btn btn-success w-50">
                    <i class="fas fa-print"></i> Cetak
                </a>
            </div>
        </form>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Tanggal Produk Masuk</th>
                    <th>Tanggal Produksi</th>
                    <th>Tanggal Expired</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produkMasuks as $item)
                    <tr>
                        <td>{{ $item->produk->kode_produk ?? '-' }}</td>
                        <td>{{ $item->produk->nama_produk ?? '-' }}</td>
                        <td>{{ $item->tgl_masuk }}</td>
                        <td>{{ $item->tgl_produksi }}</td>
                        <td>{{ $item->tgl_exp }}</td>
                        <td>{{ $item->jumlah }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Tidak ada data produk masuk</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
