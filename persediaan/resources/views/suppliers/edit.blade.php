@extends('layouts.main')

@section('content')
<h2>Edit Supplier</h2>
<form action="{{ route('suppliers.update', $supplier) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="{{ $supplier->nama }}" required>
    </div>
    <div class="mb-3">
        <label>Alamat</label>
        <input type="text" name="alamat" class="form-control" value="{{ $supplier->alamat }}" required>
    </div>
    <div class="mb-3">
        <label>No HP</label>
        <input type="text" name="nohp" class="form-control" value="{{ $supplier->nohp }}" required>
    </div>
    <button class="btn btn-primary">Update</button>
    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection