@extends('layouts.main')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Laporan Stok Produk</h5>
    </div>
    <div class="card-body">
        <form method="GET" class="row g-3 mb-4">
            <div class="col-md-3">
                <label for="tanggal_awal" class="form-label">Tanggal Produksi Awal</label>
                <input type="date" id="tanggal_awal" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
            </div>
            <div class="col-md-3">
                <label for="tanggal_akhir" class="form-label">Tanggal Produksi Akhir</label>
                <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
            </div>
            <div class="col-md-2 d-flex align-items-end gap-2">
                <button class="btn btn-primary w-50" type="submit">Filter</button>
                <a href="{{ route('laporan.stok.cetak', request()->all()) }}" target="_blank" class="btn btn-success w-50">
                    <i class="fas fa-file-pdf"></i> Cetak
                </a>
            </div>
        </form>

        <div class="table-responsive">
            <table id="example" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
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
                    @forelse ($stokList as $stok)
                        <tr>
                            <td>{{ $stok->kode_produk }}</td>
                            <td>{{ $stok->nama_produk }}</td>
                            <td>{{ $stok->jenis }}</td>
                            <td>{{ $stok->satuan }}</td>
                            <td>{{ $stok->total_masuk }}</td>
                            <td>{{ $stok->total_keluar }}</td>
                            <td>{{ $stok->stok_akhir }}</td>
                            <td>{{ \Carbon\Carbon::parse($stok->tgl_produksi_terakhir)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($stok->tgl_exp_terakhir)->format('d-m-Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">Tidak ada data stok</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
