<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        $stoks = Stok::all();
        $today = now();

        $will_expired = Stok::whereBetween('tgl_exp_terakhir', [$today, $today->copy()->addDays(21)])->count();
        $expired = Stok::where('tgl_exp_terakhir', '=', $today->copy()->subDay())->count();
        //$expired = Stok::where('tgl_exp_terakhir', '<', $today)->count();

        if ($expired > 0 || $will_expired > 0) {
            $message = '';

            if ($expired > 0) {
                $message .= "$expired produk sudah expired.<br>";
            }

            if ($will_expired > 0) {
                $message .= "$will_expired produk akan expired dalam 3 minggu.";
            }

            // Simpan session sementara
            session(['stok_alert' => $message]);
            session(['notif_count' => $expired + $will_expired]);

        }

        return view('stoks.index', compact('stoks'));
    }

    public function expired()
    {
        $today = now();

        $will_expired = Stok::whereBetween('tgl_exp_terakhir', [$today, $today->copy()->addDays(21)])->get();
        $expired = Stok::where('tgl_exp_terakhir', '<', $today)->get();

        return view('stoks.expired', compact('will_expired', 'expired'));
    }
    public function clearAlert(Request $request)
    {
        session()->forget(['stok_alert', 'notif_count']);
        return response()->json(['status' => 'cleared']);
    }

}
