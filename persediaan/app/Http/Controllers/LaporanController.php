<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukMasuk;
use App\Models\ProdukKeluar;
use App\Models\Stok;
use PDF;

class LaporanController extends Controller
{
    // =======================
    // Laporan Produk Masuk
    // =======================
    public function produkMasuk(Request $request)
    {
        $query = ProdukMasuk::with('produk');

        if ($request->filled('tanggal_awal')) {
            $query->whereDate('tgl_masuk', '>=', $request->tanggal_awal);
        }
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tgl_masuk', '<=', $request->tanggal_akhir);
        }
        if ($request->filled('nama_produk')) {
            $query->whereHas('produk', function ($q) use ($request) {
                $q->where('nama_produk', 'like', '%' . $request->nama_produk . '%');
            });
        }

        $produkMasuks = $query->orderBy('tgl_masuk', 'desc')->get();

        return view('laporanpm.index', compact('produkMasuks', 'request'));
    }

    public function cetakProdukMasukPdf(Request $request)
    {
        $query = ProdukMasuk::with('produk');

        if ($request->filled('tanggal_awal')) {
            $query->whereDate('tgl_masuk', '>=', $request->tanggal_awal);
        }
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tgl_masuk', '<=', $request->tanggal_akhir);
        }
        if ($request->filled('nama_produk')) {
            $query->whereHas('produk', function ($q) use ($request) {
                $q->where('nama_produk', 'like', '%' . $request->nama_produk . '%');
            });
        }

        $produkMasuks = $query->orderBy('tgl_masuk', 'desc')->get();

        $pdf = PDF::loadView('laporanpm.cetak_pdf', compact('produkMasuks', 'request'));

        return $pdf->download('laporan-produk-masuk.pdf');
    }

    // =======================
    // Laporan Produk Keluar
    // =======================
    public function produkKeluar(Request $request)
    {
        $query = ProdukKeluar::with('produk');

        if ($request->filled('tanggal_awal')) {
            $query->whereDate('tgl_keluar', '>=', $request->tanggal_awal);
        }
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tgl_keluar', '<=', $request->tanggal_akhir);
        }
        if ($request->filled('nama_produk')) {
            $query->whereHas('produk', function ($q) use ($request) {
                $q->where('nama_produk', 'like', '%' . $request->nama_produk . '%');
            });
        }

        $produkKeluar = $query->orderBy('tgl_keluar', 'desc')->get();

        return view('laporanpk.index', compact('produkKeluar', 'request'));
    }

    public function cetakProdukKeluarPdf(Request $request)
    {
        $query = ProdukKeluar::with('produk');

        if ($request->filled('tanggal_awal')) {
            $query->whereDate('tgl_keluar', '>=', $request->tanggal_awal);
        }
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tgl_keluar', '<=', $request->tanggal_akhir);
        }
        if ($request->filled('nama_produk')) {
            $query->whereHas('produk', function ($q) use ($request) {
                $q->where('nama_produk', 'like', '%' . $request->nama_produk . '%');
            });
        }

        $produkKeluar = $query->orderBy('tgl_keluar', 'desc')->get();

        $pdf = PDF::loadView('laporanpk.cetak_pdf', compact('produkKeluar', 'request'));

        return $pdf->download('laporan-produk-keluar.pdf');
    }

    // =======================
    // Laporan Stok
    // =======================
    public function stok(Request $request)
    {
        $query = Stok::query();

        // Filter berdasarkan nama produk
        if ($request->filled('nama_produk')) {
            $query->where('nama_produk', 'like', '%' . $request->nama_produk . '%');
        }

        // Filter berdasarkan tanggal produksi
        if ($request->filled('tanggal_awal')) {
            $query->whereDate('tgl_produksi_terakhir', '>=', $request->tanggal_awal);
        }
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tgl_produksi_terakhir', '<=', $request->tanggal_akhir);
        }

        $stokList = $query->orderBy('nama_produk')->get();

        return view('laporanstok.index', compact('stokList', 'request'));
    }

    public function cetakLaporanStokPdf(Request $request)
    {
        $query = Stok::query();

        if ($request->filled('nama_produk')) {
            $query->where('nama_produk', 'like', '%' . $request->nama_produk . '%');
        }
            
        // Filter berdasarkan tanggal produksi
        if ($request->filled('tanggal_awal')) {
            $query->whereDate('tgl_produksi_terakhir', '>=', $request->tanggal_awal);
        }
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tgl_produksi_terakhir', '<=', $request->tanggal_akhir);
        }


        $stokList = $query->orderBy('nama_produk')->get();

        $pdf = PDF::loadView('laporanstok.cetak_pdf', compact('stokList', 'request'));

        return $pdf->download('laporan-stok.pdf');
    }
}
