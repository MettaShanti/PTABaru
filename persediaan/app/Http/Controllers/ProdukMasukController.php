<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\produkMasuk;
use Illuminate\Http\Request;

class ProdukMasukController extends Controller
{
    public function index()
    {
        $produkMasuks = ProdukMasuk::with('produk')->get();
        return view('produk_masuks.index', compact('produkMasuks'));
    }

    public function create()
    {
        $produks = produk::all();
        return view('produk_masuks.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,kode_produk',
            'tgl_masuk' => 'required|date',
            'tgl_produksi' => 'required|date',
            'tgl_exp' => 'required|date',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Simpan data produk masuk
        $produkMasuk = ProdukMasuk::create([
            'produk_id' => $request->produk_id,
            'tgl_masuk' => $request->tgl_masuk,
            'tgl_produksi' => $request->tgl_produksi,
            'tgl_exp' => $request->tgl_exp,
            'jumlah' => $request->jumlah,
        ]);

        // Tambahkan stok pada tabel produks
        $produk = \App\Models\Produk::findOrFail($request->produk_id);
        $produk->stok += $request->jumlah;
        $produk->save();

        return redirect()->route('produk-masuks.index')->with('success', 'Produk masuk berhasil ditambahkan dan stok bertambah.');
    }

    public function edit(ProdukMasuk $produkMasuk)
    {
        $produks = Produk::all();
        return view('produk_masuks.edit', compact('produkMasuk', 'produks'));
    }

    public function update(Request $request, ProdukMasuk $produkMasuk)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,kode_produk',
            'tgl_masuk' => 'required|date',
            'tgl_produksi' => 'required|date',
            'tgl_exp' => 'required|date',
            'jumlah' => 'required|integer',
        ]);

        $produkMasuk->update($request->all());
        return redirect()->route('produk-masuks.index')->with('success', 'Produk masuk berhasil diupdate.');
    }

    public function destroy(ProdukMasuk $produkMasuk)
    {
        // Kurangi stok saat data produk masuk dihapus
        $produk = Produk::find($produkMasuk->produk_id);
        if ($produk) {
            // Pastikan stok tidak menjadi negatif
            if ($produk->stok >= $produkMasuk->jumlah) {
                $produk->stok -= $produkMasuk->jumlah;
            } else {
                $produk->stok = 0;
            }
            $produk->save();
        }

        $produkMasuk->delete();

        return redirect()->route('produk-masuks.index')->with('success', 'Data produk masuk berhasil dihapus dan stok dikurangi.');
    }

}
