@extends('layouts.main')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Data Produk Keluar</h2>
    <a href="{{ route('produk-keluars.create') }}" class="btn btn-primary">Tambah Produk Keluar</a>
</div>

<table id="example" class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Tanggal Keluar</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produkKeluars as $pk)
        <tr>
            <td>{{ $pk->produk->kode_produk ?? '-' }}</td>
            <td>{{ $pk->produk->nama_produk ?? '-' }}</td>
            <td>{{ $pk->tgl_keluar }}</td>
            <td>{{ $pk->jumlah }}</td>
            <td>{{ $pk->satuan }}</td>
            <td>{{ $pk->status }}</td>
            <td>
                <a href="{{ route('produk-keluars.edit', $pk) }}" class="btn btn-xs btn-warning">Ubah</a>
                <form action="{{ route('produk-keluars.destroy', $pk) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-xs btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection