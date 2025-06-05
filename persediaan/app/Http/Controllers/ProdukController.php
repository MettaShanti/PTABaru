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

        // Generate kode_produk secara otomatis
        $last = Produk::orderBy('id', 'desc')->first();
        $nextId = $last ? $last->id + 1 : 1;
        $kode_produk = 'P' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

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

    public function show(Produk $produk)
    {
        //return view('produks.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        $suppliers = Supplier::all();
        return view('produks.edit', compact('produk', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|max:30',
            'jenis' => 'required|max:15',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'satuan' => 'required|max:20',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $produk = Produk::findOrFail($id);
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