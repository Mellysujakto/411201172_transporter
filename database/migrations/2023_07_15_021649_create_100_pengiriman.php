<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Create100Pengiriman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        for ($i = 0; $i < 100; $i++) {
            $randomNo = Str::random(10);
            DB::table('pengiriman')->insert(
                array(
                    'no_pengiriman' => "TRX-$randomNo",
                    'tanggal' => Carbon::now()->toDateTimeLocalString(),
                    'lokasi_id' => 1,
                    'barang_id' => 1,
                    'jumlah_barang' => 5,
                    'harga_barang' => 9990 + $i,
                    'kurir_id' => 2,
                    'is_approved' => true,
                    'created_at' => Carbon::now()->toDateTimeLocalString(),
                    'updated_at' => Carbon::now()->toDateTimeLocalString(),
                )
            );
        }
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
