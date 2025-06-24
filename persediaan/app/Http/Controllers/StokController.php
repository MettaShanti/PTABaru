<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::now()->startOfDay();
        $query = Stok::query();

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('tgl_exp_terakhir', [$request->from, $request->to]);
        }

        $stoks = $query->get();

        // Produk dianggap expired jika <= hari ini + 3 hari
        $expired_limit = $today->copy()->addDays(3);
        $expired = Stok::whereDate('tgl_exp_terakhir', '<=', $expired_limit)->get();

        // Produk akan expired dimulai 4 hari dari sekarang sampai 3 minggu ke depan
        $will_expired = Stok::whereBetween('tgl_exp_terakhir', [
            $today->copy()->addDays(4),
            $today->copy()->addWeeks(3)->endOfDay()
        ])->get();

        // Session notif
        $will_expired_count = $will_expired->count();
        if ($will_expired_count > 0) {
            session([
                'stok_alert' => "$will_expired_count produk akan expired dalam 3 minggu.",
                'notif_count' => $will_expired_count
            ]);
        } else {
            session()->forget(['stok_alert', 'notif_count']);
        }

        return view('stoks.index', compact('stoks', 'expired', 'will_expired'));
    }

    public function clearAlert()
    {
        session()->forget('stok_alert');
        return response()->json(['message' => 'Alert cleared']);
    }

    public function expired()
    {
        $now = Carbon::now()->startOfDay();
        $expired_limit = $now->copy()->addDays(3);
        $in3Weeks = $now->copy()->addWeeks(3)->endOfDay();

        // Produk dianggap expired jika <= 3 hari dari sekarang
        $expired = Stok::whereDate('tgl_exp_terakhir', '<=', $expired_limit)->get();

        // Produk yang akan expired dimulai dari 4 hari ke depan sampai 3 minggu
        $will_expired = Stok::whereBetween('tgl_exp_terakhir', [
            $now->copy()->addDays(4),
            $in3Weeks
        ])->get();

        return view('stoks.expired', compact('expired', 'will_expired'));
    }

}
