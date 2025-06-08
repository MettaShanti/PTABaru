<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Models\Stok;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $today = Carbon::today();
            $in3Weeks = $today->copy()->addDays(21); // 3 minggu dari sekarang

            $will_expired = Stok::whereNotNull('tgl_exp_terakhir')
                ->whereBetween('tgl_exp_terakhir', [$today, $in3Weeks])
                ->get();

            $notif_count = $will_expired->count();

            if ($notif_count > 0) {
                session([
                    'stok_alert' => "$notif_count produk akan expired dalam 3 minggu.",
                    'notif_count' => $notif_count,
                ]);
            } else {
                session()->forget(['stok_alert', 'notif_count']);
            }

            $view->with('notif_count', $notif_count);
        });
    }

}
