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
        // Label produk
        $produk = Produk::orderBy('nama_produk')->get();
        $labels = $produk->pluck('nama_produk')->toArray();

        // Stok akhir dari view_stok
        $stokDataRaw = Stok::all()->keyBy('nama_produk');
        $stokData = collect($labels)->map(fn($nama) => $stokDataRaw[$nama]->stok_akhir ?? 0);

        // Produk Masuk
        $produkMasukRaw = ProdukMasuk::with('produk')->get()
            ->groupBy('produk.nama_produk')
            ->map(fn($item) => $item->sum('jumlah'));
        $produkMasukData = collect($labels)->map(fn($nama) => $produkMasukRaw[$nama] ?? 0);

        // Produk Keluar
        $produkKeluarRaw = ProdukKeluar::with('produk')->get()
            ->groupBy('produk.nama_produk')
            ->map(fn($item) => $item->sum('jumlah'));
        $produkKeluarData = collect($labels)->map(fn($nama) => $produkKeluarRaw[$nama] ?? 0);

        // Data expired & akan expired
        $today = now()->startOfDay();
        $in3weeks = now()->addWeeks(3)->endOfDay();

        $expired = Stok::whereDate('tgl_exp_terakhir', '<=', $today)->get();
        $will_expired = Stok::whereDate('tgl_exp_terakhir', '>', $today)
                            ->whereDate('tgl_exp_terakhir', '<=', $in3weeks)
                            ->get();

        $expiredCount = $expired->count();
        $willExpiredCount = $will_expired->count();

        // Kirim ke view
        return view('dashboard', [
            'labels' => $labels,
            'stokData' => $stokData,
            'produkMasukData' => $produkMasukData,
            'produkKeluarData' => $produkKeluarData,
            'expiredCount' => $expiredCount,
            'willExpiredCount' => $willExpiredCount,
            'expired' => $expired,               
            'will_expired' => $will_expired,     
        ]);
    }
}
