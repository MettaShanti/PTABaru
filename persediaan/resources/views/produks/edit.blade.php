    @extends('layouts.main')

    @section('content')
    <h2>Edit Produk</h2>
    <form action="{{ route('produks.update', $produk->kode_produk) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-2">
            <label>Kode Produk</label>
            <input type="text" name="kode_produk" class="form-control" value="{{ $produk->kode_produk }}" required>
        </div>
        <div class="mb-2">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" value="{{ $produk->nama_produk }}" required>
        </div>
        <div class="mb-2">
            <label>Jenis</label>
            <input type="text" name="jenis" class="form-control" value="{{ $produk->jenis }}" required>
        </div>
        <div class="mb-2">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $produk->harga }}" required>
        </div>
        <div class="mb-2">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ $produk->stok }}" required>
        </div>
        <div class="mb-3">
            <label>Satuan</label>
            <select name="satuan" class="form-control" required>
                <option value="">Pilih Satuan</option>
                <option value="dus">Dus</option>
                <option value="box">Box</option>
                <option value="pack">Pack</option>
            </select>
        </div>
        <div class="mb-2">
            <label>Supplier</label>
            <select name="supplier_id" class="form-control" required>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ $produk->supplier_id == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
    @endsection