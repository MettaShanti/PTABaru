@extends('layouts.main')

@section('content')
<h2>Tambah Produk Masuk</h2>
<form action="{{ route('produk-masuks.store') }}" method="POST">
    @csrf
    <select name="produk_id" class="form-control" required>
    <option value="">Pilih Produk</option>
    @foreach($produks as $produk)
        <option value="{{ $produk->kode_produk }}">{{ $produk->nama_produk }} ({{ $produk->kode_produk }})</option>
    @endforeach
</select>

    <div class="mb-3">
        <label>Tgl Masuk</label>
        <input type="date" name="tgl_masuk" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Tgl Produksi</label>
        <input type="date" name="tgl_produksi" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Tgl Exp</label>
        <input type="date" name="tgl_exp" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Jumlah</label>
        <input type="number" name="jumlah" class="form-control" required>
    </div>
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('produk-masuks.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection