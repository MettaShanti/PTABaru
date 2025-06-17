@extends('layouts.main')

@section('content')
<div class="container">
    <h2 class="mb-4">Informasi Stok Expired</h2>

    {{-- Produk Sudah Expired --}}
    <h4 class="mt-4">Sudah Expired (termasuk hari ini)</h4>
    <table class="table table-bordered">
        <thead>
            <tr class="table-danger">
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Stok Akhir</th>
                <th>Tanggal Expired</th>
            </tr>
        </thead>
        <tbody>
            @forelse($expired as $stok)
            <tr class="table-danger">
                <td>{{ $stok->kode_produk }}</td>
                <td>{{ $stok->nama_produk }}</td>
                <td>{{ $stok->stok_akhir }}</td>
                <td>{{ \Carbon\Carbon::parse($stok->tgl_exp_terakhir)->format('d-m-Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Tidak ada produk yang sudah expired.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Produk Akan Expired --}}
    <h4 class="mt-4">Akan Expired (dalam 3 minggu ke depan)</h4>
    <table class="table table-bordered">
        <thead>
            <tr class="table-warning">
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Stok Akhir</th>
                <th>Tanggal Expired</th>
            </tr>
        </thead>
        <tbody>
            @forelse($will_expired as $stok)
            <tr class="table-warning">
                <td>{{ $stok->kode_produk }}</td>
                <td>{{ $stok->nama_produk }}</td>
                <td>{{ $stok->stok_akhir }}</td>
                <td>{{ \Carbon\Carbon::parse($stok->tgl_exp_terakhir)->format('d-m-Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Tidak ada produk yang akan expired dalam 3 minggu.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('stoks.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
