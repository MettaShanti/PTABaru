<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW view_laporan_stok AS
            SELECT 
                p.kode_produk AS produk_id,
                p.kode_produk,
                p.nama_produk,
                p.jenis,
                p.satuan,
                s.nama AS nama_supplier,
                COALESCE(pm.total_masuk, 0) AS total_masuk,
                COALESCE(pk.total_keluar, 0) AS total_keluar,
                (COALESCE(pm.total_masuk, 0) - COALESCE(pk.total_keluar, 0)) AS stok_akhir,
                pm.tgl_produksi_terakhir,
                pm.tgl_exp_terakhir
            FROM produks p
            LEFT JOIN suppliers s ON s.id = p.supplier_id
            LEFT JOIN (
                SELECT 
                    produk_id,
                    SUM(jumlah) AS total_masuk,
                    MAX(tgl_produksi) AS tgl_produksi_terakhir,
                    MAX(tgl_exp) AS tgl_exp_terakhir
                FROM produk_masuks
                GROUP BY produk_id
            ) pm ON pm.produk_id = p.kode_produk
            LEFT JOIN (
                SELECT 
                    produk_id,
                    SUM(jumlah) AS total_keluar
                FROM produk_keluars
                GROUP BY produk_id
            ) pk ON pk.produk_id = p.kode_produk
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_laporanstok');
    }
};
