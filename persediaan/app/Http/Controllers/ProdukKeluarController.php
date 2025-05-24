<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\produkKeluar;
use Illuminate\Http\Request;

class ProdukKeluarController extends Controller
{
    public function index()
    {
        $produkKeluars = ProdukKeluar::with('produk')->get();
        return view('produk_keluars.index', compact('produkKeluars'));
    }

    public function create()
    {
        $produks = Produk::all();
        return view('produk_keluars.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'tgl_keluar' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required',
            'status' => 'required',
        ]);

        // Simpan data produk keluar
        $produkKeluar = ProdukKeluar::create([
            'produk_id' => $request->produk_id,
            'tgl_keluar' => $request->tgl_keluar,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'status' => $request->status,
        ]);

        // Kurangi stok pada tabel produks
        $produk = \App\Models\Produk::findOrFail($request->produk_id);
        if ($produk->stok < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak cukup untuk dikurangi!');
        }
        $produk->stok -= $request->jumlah;
        $produk->save();

        return redirect()->route('produk-keluars.index')->with('success', 'Produk keluar berhasil ditambahkan dan stok berkurang.');
    }

    public function show(ProdukKeluar $produkKeluar)
    {
        return view('produk_keluars.show', compact('produkKeluar'));
    }

    public function edit(ProdukKeluar $produkKeluar)
    {
        $produks = Produk::all();
        return view('produk_keluars.edit', compact('produkKeluar', 'produks'));
    }

    public function update(Request $request, ProdukKeluar $produkKeluar)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'tgl_keluar' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|max:15',
            'status' => 'required|string',
        ]);

        // Jika produk atau jumlah berubah, update stok
        if ($produkKeluar->produk_id != $request->produk_id || $produkKeluar->jumlah != $request->jumlah) {
            // Kembalikan stok lama
            $produkLama = Produk::find($produkKeluar->produk_id);
            if ($produkLama) {
                $produkLama->stok += $produkKeluar->jumlah;
                $produkLama->save();
            }
            // Kurangi stok baru
            $produkBaru = produk::findOrFail($request->produk_id);
            if ($produkBaru->stok < $request->jumlah) {
                return back()->with('error', 'Stok tidak mencukupi!');
            }
            $produkBaru->stok -= $request->jumlah;
            $produkBaru->save();
        }

        $produkKeluar->update([
            'produk_id' => $request->produk_id,
            'tgl_keluar' => $request->tgl_keluar,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'status' => $request->status,
        ]);

        return redirect()->route('produk-keluars.index')->with('success', 'Produk keluar berhasil diupdate dan stok diperbarui.');
    }

    public function destroy(ProdukKeluar $produkKeluar)
    {
        // Kembalikan stok saat data dihapus
        $produk = Produk::find($produkKeluar->produk_id);
        if ($produk) {
            $produk->stok += $produkKeluar->jumlah;
            $produk->save();
        }
        $produkKeluar->delete();
        return redirect()->route('produk-keluars.index')->with('success', 'Produk keluar berhasil dihapus dan stok dikembalikan.');
    }
}
