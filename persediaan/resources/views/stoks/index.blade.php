@extends('layouts.main')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Data Stok</h2>
    <a href="{{ route('stoks.expired') }}" class="btn btn-warning">Informasi Produk Expired</a>
</div>
<table class="table table-bordered">
    <thead class="table-dark">
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
        @foreach($stoks as $stok)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $stok->kode_produk }}</td>
            <td>{{ $stok->nama_produk }}</td>
            <td>{{ $stok->jenis }}</td>
            <td>{{ $stok->satuan }}</td>
            <td>{{ $stok->total_masuk }}</td>
            <td>{{ $stok->total_keluar }}</td>
            <td>{{ $stok->stok_akhir }}</td>
            <td>{{ $stok->tgl_produksi_terakhir }}</td>
            <td>{{ $stok->tgl_exp_terakhir }}</td>
            <td>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection