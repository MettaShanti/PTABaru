<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StokController extends Controller
{
public function index(Request $request)
{
    $today = now();
    $query = Stok::query();

    if ($request->filled('from') && $request->filled('to')) {
        $query->whereBetween('tgl_exp_terakhir', [$request->from, $request->to]);
    }

    $stoks = $query->get();

    $expired = Stok::whereDate('tgl_exp_terakhir', '<', $today)->get();
    $will_expired = Stok::whereBetween('tgl_exp_terakhir', [$today, $today->copy()->addDays(21)])->get();

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
    $now = Carbon::now();
    $in3Weeks = Carbon::now()->addWeeks(3);

    $expired = Stok::whereDate('tgl_exp_terakhir', '<', $now)->get();
    $will_expired = Stok::whereBetween('tgl_exp_terakhir', [$now, $in3Weeks])->get();

    return view('stoks.expired', compact('expired', 'will_expired'));
}

  public function show($id)
{
$stok = Stok::where('kode_produk', $id)->firstOrFail(); // gunakan kolom yang unik di view, misalnya `kode_produk`
    return view('stoks.show', compact('stok'));
}


}
