<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = 'lokasi';
    protected $fillable = ['id', 'kode_lokasi', 'nama_lokasi'];
    const CREATED_AT = null;
    const UPDATED_AT = null;
}
