<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class CreateDefaultPengirimanRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('pengiriman')->insert(
            array(
                'no_pengiriman' => 'TRX-1',
                'tanggal' => Carbon::now()->toDateTimeLocalString(),
                'lokasi_id' => 1,
                'barang_id' => 1,
                'jumlah_barang' => 5,
                'harga_barang' => 10000,
                'kurir_id' => 2,
                'is_approved' => false,
                'created_at' => Carbon::now()->toDateTimeLocalString(),
                'updated_at' => Carbon::now()->toDateTimeLocalString(),
            )
        );

        DB::table('pengiriman')->insert(
            array(
                'no_pengiriman' => 'TRX-2',
                'tanggal' => Carbon::now()->toDateTimeLocalString(),
                'lokasi_id' => 1,
                'barang_id' => 1,
                'jumlah_barang' => 10,
                'harga_barang' => 20000,
                'kurir_id' => 2,
                'is_approved' => false,
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
