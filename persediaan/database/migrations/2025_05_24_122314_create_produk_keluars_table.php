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
        Schema::create('produk_keluars', function (Blueprint $table) {
           $table->id();
            $table->string('produk_id', 10);
            $table->foreign('produk_id')
                  ->references('kode_produk')
                  ->on('produks')
                  ->onDelete('cascade');
            $table->date('tgl_keluar');
            $table->integer('jumlah');
            $table->string('satuan', 15);
            $table->string('status', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_keluars');
    }
};
