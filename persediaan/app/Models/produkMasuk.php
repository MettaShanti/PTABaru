<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produkMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id',
        'tgl_masuk',
        'tgl_produksi',
        'tgl_exp',
        'jumlah',
    ];

    public function produk()
    {
    return $this->belongsTo(Produk::class, 'produk_id', 'kode_produk');
    }
}
