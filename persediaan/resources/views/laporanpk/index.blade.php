@extends('layouts.main')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Laporan Produk Keluar</h5>
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
            <div class="col-md-2 d-flex align-items-end gap-2">
                <button class="btn btn-primary w-50" type="submit">Filter</button>
                <a href="{{ route('laporan.produk-keluar.cetak', request()->all()) }}" target="_blank" class="btn btn-success w-50">
                    <i class="fas fa-print"></i> Cetak
                </a>
            </div>
        </form>

        <table id="example" class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Tanggal Keluar</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produkKeluar as $pk)
                <tr>
                    <td>{{ $pk->produk->kode_produk ?? '-' }}</td>
                    <td>{{ $pk->produk->nama_produk ?? '-' }}</td>
                    <td>{{ $pk->tgl_keluar }}</td>
                    <td>{{ $pk->jumlah }}</td>
                    <td>{{ $pk->satuan }}</td>
                    <td>{{ $pk->status }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Tidak ada data produk keluar</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
