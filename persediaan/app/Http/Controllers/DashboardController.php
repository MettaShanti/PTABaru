<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Produk;
use App\Models\ProdukMasuk;
use App\Models\ProdukKeluar;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    // // Notifikasi stok
    // $stokNotif = Stok::getStokNotifications();
    // if ($stokNotif['total'] > 0) {
    //     session()->flash('stok_alert', $stokNotif['message']);
    //     session()->flash('notif_count', $stokNotif['total']);
    // }

    // mengambil semua nama produk
    $produk = Produk::orderBy('nama_produk')->get();
    $labels = $produk->pluck('nama_produk')->toArray();

    // Data stok akhir dari view_stok
    $stokDataRaw = Stok::all()->keyBy('nama_produk');
    $stokData = collect($labels)->map(fn($nama) => $stokDataRaw[$nama]->stok_akhir ?? 0);

    // Data produk masuk
    $produkMasukRaw = ProdukMasuk::with('produk')->get()
        ->groupBy('produk.nama_produk')
        ->map(fn($item) => $item->sum('jumlah'));
    $produkMasukData = collect($labels)->map(fn($nama) => $produkMasukRaw[$nama] ?? 0);

    // Data produk keluar
    $produkKeluarRaw = ProdukKeluar::with('produk')->get()
        ->groupBy('produk.nama_produk')
        ->map(fn($item) => $item->sum('jumlah'));
    $produkKeluarData = collect($labels)->map(fn($nama) => $produkKeluarRaw[$nama] ?? 0);

    return view('dashboard', compact('labels', 'stokData', 'produkMasukData', 'produkKeluarData'));
}

}
