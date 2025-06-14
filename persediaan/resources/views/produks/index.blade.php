@extends('layouts.main')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Data Produk</h2>
    <a href="{{ route('produks.create') }}" class="btn btn-primary">Tambah Produk</a>
</div>

<table id="example" class="table table-bordered" style="width:100%">
    <thead class="table-dark">
        <tr>
            <th>Kode Produk</th>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Satuan</th>
            <th>Supplier</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produks as $produk)
        <tr>
            <td>{{ $produk->kode_produk }}</td>
            <td>{{ $produk->nama_produk }}</td>
            <td>{{ $produk->jenis }}</td>
            <td>{{ number_format($produk->harga) }}</td>
            <td>{{ $produk->stok }}</td>
            <td>{{ $produk->satuan }}</td>
            <td>{{ $produk->supplier->nama ?? '-' }}</td>
            <td>
                <a href="{{ route('produks.edit', $produk->kode_produk) }}" class="btn btn-xs btn-warning">Ubah</a>
                <form action="{{ route('produks.destroy', $produk->kode_produk) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-xs btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection