@extends('layouts.main')

@section('content')
<h2>Edit Produk Masuk</h2>
<form action="{{ route('produk-masuks.update', $produkMasuk) }}" method="POST">
    @csrf @method('PUT')
    <select name="produk_id" class="form-control" required>
    <option value="">Pilih Produk</option>
    @foreach($produks as $produk)
        <option value="{{ $produk->kode_produk }}" {{ $produkMasuk->produk_id == $produk->kode_produk ? 'selected' : '' }}>{{ $produk->nama_produk }} ({{ $produk->kode_produk }})</option>
    @endforeach
</select>
    <div class="mb-3">
        <label>Tgl Masuk</label>
        <input type="date" name="tgl_masuk" class="form-control" value="{{ $produkMasuk->tgl_masuk }}" required>
    </div>
    <div class="mb-3">
        <label>Tgl Produksi</label>
        <input type="date" name="tgl_produksi" class="form-control" value="{{ $produkMasuk->tgl_produksi }}" required>
    </div>
    <div class="mb-3">
        <label>Tgl Exp</label>
        <input type="date" name="tgl_exp" class="form-control" value="{{ $produkMasuk->tgl_exp }}" required>
    </div>
    <div class="mb-3">
        <label>Jumlah</label>
        <input type="number" name="jumlah" class="form-control" value="{{ $produkMasuk->jumlah }}" required>
    </div>
    <button class="btn btn-primary">Update</button>
    <a href="{{ route('produk-masuks.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection