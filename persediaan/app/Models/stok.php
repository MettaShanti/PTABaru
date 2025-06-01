<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class stok extends Model
{
    /**
     * Nama tabel atau view yang digunakan oleh model ini
     *
     * @var string
     */
    protected $table = 'view_stok';

    /**
     * View tidak menggunakan created_at dan updated_at
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Kolom yang tidak boleh diisi secara massal
     *
     * @var array
     */
    protected $guarded = [];

}
