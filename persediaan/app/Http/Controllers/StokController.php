<?php

namespace App\Http\Controllers;

use App\Models\stok;
use Illuminate\Http\Request;

class StokController extends Controller
{
     public function index()
    {
        $stoks = stok::all();
        return view('stoks.index', compact('stoks'));
    }

    // Notifikasi expired stok
    public function expired()
    {
        $today = now();
        // Notifikasi stok yang akan expired dalam 3 minggu (21 hari) ke depan
        $will_expired = Stok::where('tgl_exp_terakhir', '<=', $today->copy()->addDays(21))
            ->where('tgl_exp_terakhir', '>=', $today)
            ->get();
        // Stok yang sudah expired
        $expired = Stok::where('tgl_exp_terakhir', '<', $today)->get();

        return view('stoks.expired', compact('will_expired', 'expired'));
    }

    public function show($id)
    {
        $stok = Stok::findOrFail($id);
        return view('stoks.show', compact('stok'));
    }
}
