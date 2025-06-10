<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode_produk';
    public $incrementing = false; // karena kode_produk bukan integer auto increment
    protected $keyType = 'string';
    
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
