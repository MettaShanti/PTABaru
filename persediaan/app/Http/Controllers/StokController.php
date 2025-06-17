<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::now()->startOfDay(); // penting: hilangkan jam!
        $query = Stok::query();

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('tgl_exp_terakhir', [$request->from, $request->to]);
        }

        $stoks = $query->get();

        // Perbaiki expired agar <= hari ini (bukan hanya <)
        $expired = Stok::whereDate('tgl_exp_terakhir', '<=', $today)->get();

        // Perbaiki will_expired mulai besok sampai 3 minggu ke depan
        $will_expired = Stok::whereBetween('tgl_exp_terakhir', [
            $today->copy()->addDay(),
            $today->copy()->addWeeks(3)->endOfDay()
        ])->get();

        // Session notif seperti sebelumnya
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
        // pastikan hanya tanggal, tanpa waktu
        $now = Carbon::now()->startOfDay();
        $in3Weeks = $now->copy()->addWeeks(3)->endOfDay();

        // Ambil data expired hingga hari ini
        $expired = Stok::whereDate('tgl_exp_terakhir', '<=', $now)->get();

        // Ambil data yang akan expired dalam 3 minggu ke depan (mulai besok)
        $will_expired = Stok::whereBetween('tgl_exp_terakhir', [$now->copy()->addDay(), $in3Weeks])->get();

        return view('stoks.expired', compact('expired', 'will_expired'));
    }
}
