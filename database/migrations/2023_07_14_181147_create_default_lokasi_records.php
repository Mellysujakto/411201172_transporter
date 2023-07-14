<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDefaultLokasiRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('lokasi')->insert(
            array(
                'kode_lokasi' => "Jakpus",
                'nama_lokasi' => "Jakarta Pusat",
                'created_at' => Carbon::now()->toDateTimeLocalString(),
                'updated_at' => Carbon::now()->toDateTimeLocalString(),
            )
        );
        DB::table('lokasi')->insert(
            array(
                'kode_lokasi' => "Jakbar",
                'nama_lokasi' => "Jakarta Barat",
                'created_at' => Carbon::now()->toDateTimeLocalString(),
                'updated_at' => Carbon::now()->toDateTimeLocalString(),
            )
        );
        DB::table('lokasi')->insert(
            array(
                'kode_lokasi' => "Jaksel",
                'nama_lokasi' => "Jakarta Selatan",
                'created_at' => Carbon::now()->toDateTimeLocalString(),
                'updated_at' => Carbon::now()->toDateTimeLocalString(),
            )
        );
        DB::table('lokasi')->insert(
            array(
                'kode_lokasi' => "Jakut",
                'nama_lokasi' => "Jakarta Utara",
                'created_at' => Carbon::now()->toDateTimeLocalString(),
                'updated_at' => Carbon::now()->toDateTimeLocalString(),
            )
        );
        DB::table('lokasi')->insert(
            array(
                'kode_lokasi' => "Jaktim",
                'nama_lokasi' => "Jakarta Timur",
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
