<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      
        DB::statement("
            CREATE VIEW view_stok AS
            SELECT 
                p.id AS produk_id,
                p.kode_produk,
                p.nama_produk,
                p.jenis,
                p.satuan,
                COALESCE(SUM(pm.jumlah),0) AS total_masuk,
                COALESCE(SUM(pk.jumlah),0) AS total_keluar,
                (COALESCE(SUM(pm.jumlah),0) - COALESCE(SUM(pk.jumlah),0)) AS stok_akhir,
                MAX(pm.tgl_produksi) AS tgl_produksi_terakhir,
                MAX(pm.tgl_exp) AS tgl_exp_terakhir
            FROM produks p
            LEFT JOIN produk_masuks pm ON pm.produk_id = p.id
            LEFT JOIN produk_keluars pk ON pk.produk_id = p.id
            GROUP BY p.id, p.kode_produk, p.nama_produk, p.jenis, p.satuan
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stoks');
    }
};
