@extends('layouts.main')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Data Produk Masuk</h2>
    <a href="{{ route('produk-masuks.create') }}" class="btn btn-primary">Tambah Produk Masuk</a>
</div>

<table id="example" class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Tgl Masuk</th>
            <th>Tgl Produksi</th>
            <th>Tgl Exp</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produkMasuks as $pm)
        <tr>
            <td>{{ $pm->produk->kode_produk ?? '-' }}</td>
            <td>{{ $pm->produk->nama_produk ?? '-' }}</td>
            <td>{{ $pm->tgl_masuk }}</td>
            <td>{{ $pm->tgl_produksi }}</td>
            <td>{{ $pm->tgl_exp }}</td>
            <td>{{ $pm->jumlah }}</td>
            <td>
                <a href="{{ route('produk-masuks.edit', $pm) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('produk-masuks.destroy', $pm) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection