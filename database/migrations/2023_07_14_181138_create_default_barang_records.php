<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDefaultBarangRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('barang')->insert(
            array(
                'kode_barang' => 1,
                'nama_barang' => "TV",
                'deskripsi' => "TV 32 Inch",
                'stok_barang' => 800,
                'created_at' => Carbon::now()->toDateTimeLocalString(),
                'updated_at' => Carbon::now()->toDateTimeLocalString(),
            )
        );
        DB::table('barang')->insert(
            array(
                'kode_barang' => 2,
                'nama_barang' => "Kulkas",
                'deskripsi' => "Kulkas 2 Pintu",
                'stok_barang' => 400,
                'created_at' => Carbon::now()->toDateTimeLocalString(),
                'updated_at' => Carbon::now()->toDateTimeLocalString(),
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
