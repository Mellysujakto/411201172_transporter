<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $table = 'pengiriman';
    protected $fillable = [
        'id',
        'no_pengiriman',
        'tanggal',
        'lokasi_id',
        'barang_id',
        'jumlah_barang',
        'harga_barang',
        'kurir_id',
        'is_approved',
    ];
}
