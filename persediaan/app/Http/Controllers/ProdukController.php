<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('supplier')->get();
        return view('produks.index', compact('produks'));
    }

    public function create()
    {
    
        $suppliers = Supplier::all();
        return view('produks.create', compact('suppliers'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_produk' => 'required|max:30',
        'jenis' => 'required|max:15',
        'harga' => 'required|integer',
        'stok' => 'required|integer',
        'satuan' => 'required|max:20',
        'supplier_id' => 'required|exists:suppliers,id',
    ]);

    // Cari kode_produk terakhir, urut dari yang terbesar
    $last = Produk::orderBy('kode_produk', 'desc')->first();

    // Ambil angka dari kode_produk terakhir, misal dari "P0123" jadi 123
    $lastNumber = $last ? (int)substr($last->kode_produk, 1) : 0;

    // Tambahkan 1 untuk kode berikutnya
    $nextNumber = $lastNumber + 1;

    // Format jadi kode seperti "P0001"
    $kode_produk = 'P' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

    Produk::create([
        'kode_produk' => $kode_produk,
        'nama_produk' => $request->nama_produk,
        'jenis' => $request->jenis,
        'harga' => $request->harga,
        'stok' => $request->stok, 
        'satuan' => $request->satuan,
        'supplier_id' => $request->supplier_id,
    ]);

    return redirect()->route('produks.index')->with('success', 'Produk berhasil ditambahkan.');
}


    public function edit(Produk $produk)
    {
        $suppliers = Supplier::all();
        return view('produks.edit', compact('produk', 'suppliers'));
    }

    public function update(Request $request, $kode_produk)
{
    $request->validate([
        'nama_produk' => 'required|max:30',
        'jenis' => 'required|max:15',
        'harga' => 'required|integer',
        'stok' => 'required|integer',
        'satuan' => 'required|max:20',
        'supplier_id' => 'required|exists:suppliers,id',
    ]);

    $produk = Produk::findOrFail($kode_produk); // karena kode_produk adalah primary key
    $produk->update([
        'nama_produk' => $request->nama_produk,
        'jenis' => $request->jenis,
        'harga' => $request->harga,
        'stok' => $request->stok,
        'satuan' => $request->satuan,
        'supplier_id' => $request->supplier_id,
    ]);

    return redirect()->route('produks.index')->with('success', 'Produk berhasil diupdate.');
}


    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('produks.index')->with('success', 'Produk berhasil dihapus.');
    }
}