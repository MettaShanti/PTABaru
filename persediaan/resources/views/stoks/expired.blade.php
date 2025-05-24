@extends('layouts.main')

@section('content')
<h2>Informasi Stok Expired</h2>

<h4>Sudah Expired</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Stok Akhir</th>
            <th>Tgl Exp Terakhir</th>
        </tr>
    </thead>
    <tbody>
        @foreach($expired as $stok)
        <tr class="table-danger">
            <td>{{ $stok->kode_produk }}</td>
            <td>{{ $stok->nama_produk }}</td>
            <td>{{ $stok->stok_akhir }}</td>
            <td>{{ $stok->tgl_exp_terakhir }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h4>Akan Expired (3 minggu ke depan)</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Stok Akhir</th>
            <th>Tgl Exp Terakhir</th>
        </tr>
    </thead>
    <tbody>
        @foreach($will_expired as $stok)
        <tr class="table-warning">
            <td>{{ $stok->kode_produk }}</td>
            <td>{{ $stok->nama_produk }}</td>
            <td>{{ $stok->stok_akhir }}</td>
            <td>{{ $stok->tgl_exp_terakhir }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('stoks.index') }}" class="btn btn-secondary">Kembali</a>
@endsection