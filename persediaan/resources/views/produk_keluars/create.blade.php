@extends('layouts.main')

@section('content')
<h2>Tambah Produk Keluar</h2>
<form action="{{ route('produk-keluars.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Pilih Produk</label>
        <select name="produk_id" id="produk_id" class="form-control" required>
            <option value="">Pilih Produk</option>
            @foreach($produks as $produk)
                <option 
                    value="{{ $produk->kode_produk }}" 
                    data-satuan="{{ $produk->satuan }}"
                >
                    {{ $produk->nama_produk }} ({{ $produk->kode_produk }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Tanggal Keluar</label>
        <input type="date" name="tgl_keluar" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Jumlah</label>
        <input type="number" name="jumlah" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Satuan</label>
        <input type="text" id="satuan" name="satuan" class="form-control" readonly required>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control" required>
            <option value="">Pilih Status</option>
            <option value="terjual">Terjual</option>
            <option value="retur">Retur</option>
            <option value="exp">Expired</option>
            <option value="rusak">Rusak</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('produk-keluars.index') }}" class="btn btn-secondary">Kembali</a>
</form>

<script>
    document.getElementById('produk_id').addEventListener('change', function() {
        var satuan = this.options[this.selectedIndex].getAttribute('data-satuan') || '';
        document.getElementById('satuan').value = satuan;
    });
</script>
@endsection
