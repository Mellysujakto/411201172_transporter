<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $fillable = ['id', 'kode_barang', 'nama_barang', 'deskripsi', 'stok_barang', 'harga_barang'];
    const CREATED_AT = null;
    const UPDATED_AT = null;
}
