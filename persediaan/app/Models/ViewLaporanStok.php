<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewLaporanStok extends Model
{
    protected $table = 'view_laporanstok';
    public $incrementing = false;
    public $timestamps = false;

    // Kolom yang ada di view
    protected $guarded = [ 
        'nama_produk',
        'stok_akhir',
        'tgl_exp_terakhir',
        'jumlah_masuk',
        'jumlah_keluar',
    ];

}
