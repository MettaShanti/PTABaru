<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
    'kode_produk', 
    'nama_produk', 
    'jenis', 
    'harga', 
    'stok', 
    'satuan', 
    'supplier_id'
];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
