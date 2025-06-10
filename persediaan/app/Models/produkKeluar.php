<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produkKeluar extends Model
{
    use HasFactory;

    protected $table = 'produk_keluars';
    protected $guarded = [];
    protected $fillable = [
        'produk_id',
        'tgl_keluar',
        'jumlah',
        'satuan',
        'status',
    ];

    public function produk()
    {
    return $this->belongsTo(Produk::class, 'produk_id', 'kode_produk');
    }
}
