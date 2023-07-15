<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Create500PengirimanRandomly extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // to achive no 1, 4 and no 2
        for ($i = 0; $i < 200; $i++) {
            $randomNo = Str::random(10);
            DB::table('pengiriman')->insert(
                array(
                    'no_pengiriman' => "TRX-$randomNo",
                    'tanggal' => Carbon::now()->toDateTimeLocalString(),
                    'lokasi_id' => 2,
                    'barang_id' => 2,
                    'jumlah_barang' => 5,
                    'harga_barang' => 990 + $i,
                    'kurir_id' => 2,
                    'is_approved' => true,
                    'created_at' => Carbon::now()->toDateTimeLocalString(),
                    'updated_at' => Carbon::now()->toDateTimeLocalString(),
                )
            );
        }
        // to achive no 1, 4 and no 2
        for ($i = 0; $i < 150; $i++) {
            $randomNo = Str::random(10);
            DB::table('pengiriman')->insert(
                array(
                    'no_pengiriman' => "TRX-$randomNo",
                    'tanggal' => Carbon::now()->toDateTimeLocalString(),
                    'lokasi_id' => 1,
                    'barang_id' => 1,
                    'jumlah_barang' => 5,
                    'harga_barang' => 990 + $i,
                    'kurir_id' => 1,
                    'is_approved' => true,
                    'created_at' => Carbon::now()->toDateTimeLocalString(),
                    'updated_at' => Carbon::now()->toDateTimeLocalString(),
                )
            );
        }
        // to achive no 3
        for ($i = 0; $i < 100; $i++) {
            $randomNo = Str::random(10);
            DB::table('pengiriman')->insert(
                array(
                    'no_pengiriman' => "TRX-$randomNo",
                    'tanggal' => Carbon::now()->toDateTimeLocalString(),
                    'lokasi_id' => 1,
                    'barang_id' => 1,
                    'jumlah_barang' => 5,
                    'harga_barang' => 990 + $i,
                    'kurir_id' => 1,
                    'is_approved' => true,
                    'created_at' => Carbon::now()->toDateTimeLocalString(),
                    'updated_at' => Carbon::now()->toDateTimeLocalString(),
                )
            );
        }
        // to achive no 3 dan 5
        for ($i = 0; $i < 50; $i++) {
            $randomNo = Str::random(10);
            DB::table('pengiriman')->insert(
                array(
                    'no_pengiriman' => "TRX-$randomNo",
                    'tanggal' => Carbon::now()->toDateTimeLocalString(),
                    'lokasi_id' => 1,
                    'barang_id' => 1,
                    'jumlah_barang' => 5,
                    'harga_barang' => 990 + $i,
                    'kurir_id' => 1,
                    'is_approved' => true,
                    'created_at' => Carbon::now()->subMonths(3)->toDateTimeLocalString(),
                    'updated_at' => Carbon::now()->subMonths(3)->toDateTimeLocalString(),
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
