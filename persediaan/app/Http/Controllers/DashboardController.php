<?php

use App\Http\Controllers\Controller;
use App\Models\Stok;


class DashboardController extends Controller
{
    public function index()
    {
        $stokNotif = Stok::getStokNotifications();

        if ($stokNotif['total'] > 0) {
            session()->flash('stok_alert', $stokNotif['message']);
            session()->flash('notif_count', $stokNotif['total']);
        }

        return view('dashboard');
    }
}
