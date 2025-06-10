<?php

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
        Schema::create('produk_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('produk_id', 10);
            $table->foreign('produk_id')->references('kode_produk')->on('produks')->onDelete('cascade');
            $table->date('tgl_masuk');
            $table->date('tgl_produksi');
            $table->date('tgl_exp');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_masuks');
    }
};
