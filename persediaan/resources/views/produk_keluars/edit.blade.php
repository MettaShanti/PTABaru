@extends('layouts.main')

@section('content')
<h2>Edit Produk Keluar</h2>
<form action="{{ route('produk-keluars.update', $produkKeluar) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Produk</label>
        <select name="produk_id" class="form-control" required>
            @foreach($produks as $produk)
                <option value="{{ $produk->id }}" {{ $produkKeluar->produk_id == $produk->id ? 'selected' : '' }}>{{ $produk->nama_produk }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Tgl Keluar</label>
        <input type="date" name="tgl_keluar" class="form-control" value="{{ $produkKeluar->tgl_keluar }}" required>
    </div>
    <div class="mb-3">
        <label>Jumlah</label>
        <input type="number" name="jumlah" class="form-control" value="{{ $produkKeluar->jumlah }}" required>
    </div>
    <div class="mb-3">
        <label>Satuan</label>
        <input type="text" name="satuan" class="form-control" value="{{ $produkKeluar->satuan }}" required>
    </div>
    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control" required>
            <option value="">Pilih Status</option>
            <option value="terjual" {{ $produkKeluar->status == 'terjual' ? 'selected' : '' }}>Terjual</option>
            <option value="retur" {{ $produkKeluar->status == 'retur' ? 'selected' : '' }}>Retur</option>
            <option value="exp" {{ $produkKeluar->status == 'exp' ? 'selected' : '' }}>Expired</option>
            <option value="rusak" {{ $produkKeluar->status == 'rusak' ? 'selected' : '' }}>Rusak</option>
        </select>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('produk-keluars.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection