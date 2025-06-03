@extends('layouts.main')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Data Supplier</h2>
    <a href="{{ route('suppliers.create') }}" class="btn btn-primary">Tambah Supplier</a>
</div>

<table id="example" class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($suppliers as $supplier)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $supplier->nama }}</td>
            <td>{{ $supplier->alamat }}</td>
            <td>{{ $supplier->nohp }}</td>
            <td>
                <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection