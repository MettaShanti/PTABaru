@extends('layouts.main')

@section('content')
<h2>Tambah Produk</h2>
<form action="{{ route('produks.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nama Produk</label>
        <input type="text" name="nama_produk" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Kategori</label>
        <select name="jenis" class="form-control" required>
            <option value="">Pilih Kategori</option>
            <option value="makanan">Makanan</option>
            <option value="snack">Snack</option>
            <option value="minuman">Minuman</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="harga" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Satuan</label>
        <select name="satuan" class="form-control" required>
            <option value="">Pilih Satuan</option>
            <option value="dus">Dus</option>
            <option value="box">Box</option>
            <option value="gross">Gross</option>
            <option value="pack">Pack</option>
            <option value="lusin">Lusin</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Supplier</label>
        <select name="supplier_id" class="form-control" required>
            <option value="">Pilih Supplier</option>
            @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Stok</label>
        <input type="number" class="form-control" value="0" readonly>
        <input type="hidden" name="stok" value="0">
        <small class="text-muted">Stok awal akan otomatis 0, dan hanya bisa bertambah lewat produk masuk.</small>
    </div>  
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('produks.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection