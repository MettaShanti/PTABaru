<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $table = 'view_stok'; // view, bukan tabel biasa
    public $timestamps = false;
    protected $guarded = [];

    protected $primaryKey = null;
    public $incrementing = false;

public static function getStokNotifications()
{
    $now = Carbon::now();
    $expired = self::whereDate('tgl_exp_terakhir', '<', $now)->get();
    $expiringSoon = self::whereBetween('tgl_exp_terakhir', [$now, $now->copy()->addWeeks(3)])->get();

    $total = $expired->count() + $expiringSoon->count();
    $message = '';

    if ($expired->count()) {
        $message .= '<span class="text-danger">' . $expired->count() . ' produk sudah kedaluwarsa.</span><br>';
    }

    if ($expiringSoon->count()) {
        $message .= '<span class="text-warning">' . $expiringSoon->count() . ' produk akan kedaluwarsa.</span>';
    }

    return [
        'total' => $total,
        'message' => $message
    ];
}

}


